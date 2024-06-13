<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Toko;
use App\Models\KodeOTP;
use App\Models\Penyewa;
use App\Models\Produk;
use App\Models\FotoProduk;
use App\Models\Series;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Mail;
use Exception;

class AutentikasiController extends Controller
{
    // REGISTER
    public function verifikasiViewOTP(Request $request)
    {
        if (!session()->has('regis')) {
            return redirect()->route('loginView');
        }

        return view('authentication.verifyFormOTP');
    }

    public function verifyOTP(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = KodeOTP::where('email', session('email'))->where('kode', $request->kode)->first();

        if ($user) {
            if (session('role') == 'penyewa') {
                return redirect()->route('registerInformationViewPenyewa');
            } elseif (session('role') == 'pemilik_sewa') {
                return redirect()->route('registerInformationViewPemilikSewa');
            } else {
                return redirect()->back()->with('error', "Role anda tidak valid");
            }
        } else {
            return redirect()->back()->with('error', 'Kode OTP Salah.');
        }
    }

    // PENYEWA

    //Masuk Halaman Registrasi tab Penyewa
    public function registerViewPenyewa(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role === "pemilik_sewa") {
                return redirect()->route('pemiliksewa.berandaView');
            } else if ($user->role === "penyewa") {
                return redirect()->route('viewHomepage');
            }
        }
        return view('authentication.register-penyewa');
    }

    //Check Email Penyewa saat Regis
    public function checkEmailPenyewa(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'setuju_syarat_dan_ketentuan' => 'accepted',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $email = strtolower($request->email);
        $u = DB::table('users')->where('email', $email)->first();
        if ($u) {
            if ($u->verifyIdentitas == "Sudah" || $u->verifyIdentitas == "Tidak") {
                return redirect()->back()->with('error', 'Alamat Email sudah terdaftar, silahkan login atau gunakan email lain!');
            }
        }

        session(['email' => $email]);
        session(['role' => "penyewa"]);
        session(['regis' => TRUE]);

        $kode_otp = mt_rand(100000, 999999);
        while (true) {
            $cekOTP = KodeOTP::where('kode', $kode_otp)->first();
            if ($cekOTP != null) {
                dd($cekOTP);
                $kode_otp = mt_rand(100000, 999999);
            } else {
                break;
            }
        }
        // cek kode
        $cek = KodeOTP::where('email', session('email'));
        if ($cek->count() > 0) {
            $cek->update([
                'kode' => $kode_otp
            ]);
        } else {
            // create otp
            KodeOTP::create([
                'email' => session('email'),
                'kode' => $kode_otp
            ]);
        }

        try {
            Mail::to(session('email'))->send(new \App\Mail\OtpMail($kode_otp));
        } catch (Exception $e) {
            return redirect()->back()->withErrors("Kode OTP Gagal Terkirim ke Email");
        }

        return redirect()->route('verifikasiViewOTP');
    }

    //Masuk ke Halaman Daftar Penyewa Bagian Informasi
    public function registerInformationViewPenyewa(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();

            if (isset($user->nama)) {
                return redirect()->route('viewHomepage');
            }
            session(['profilpath' => $user->foto_profil]);
        } else if (session()->has('regis')) {
            return view('authentication.register-penyewa-informasi');
        } else {
            return redirect()->back();
        }
    }

    //Action dari Halaman Daftar Informasi Penyewa
    public function registerInformationActionPenyewa(Request $request)
    {
        //SIMPAN INFORMASI AKUN BARU SAAT REGISTER
        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min_digits:8,',
            'nama' => 'required|string',
            'nomor_identitas' => 'required|numeric|min_digits:16|max_digits:16|unique:users,NIK',
            'link_sosial_media' => 'required|url',
            'nomor_telpon' => 'required|numeric|min_digits:10|max_digits:13|unique:users,no_telp',
            'nomor_telpon_darurat' => 'required|numeric|min_digits:10|max_digits:13',
            'alamat' => 'required|string',
            'provinsi' => 'required|string',
            'kota' => 'required|in:Kota Bandung,Kabupaten Bandung',
            'kodePos' => 'required|numeric|min_digits:5|max_digits:5',
            'foto_identitas' => 'file|mimes:jpg,jpeg,png,webp|max:5120',
            'foto_diri' => 'file|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        if (session()->has('email')) {
            $email = Session::get('email');
        } else {
            return redirect()->route('registerViewPenyewa')->with('error', 'Error! Silahkan coba daftar ulang');
        }

        if ($request->nomor_telpon == $request->nomor_telpon_darurat) {
            return redirect()->back()->withErrors("Nomor darurat tidak boleh sama dengan nomor telepon pribadi")->withInput();
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $photoPath = $request->file('foto_identitas')->store('public/identitas');
        $photoPath = Str::replaceFirst('public/', 'storage/', $photoPath);

        $photoPathDiri = $request->file('foto_diri')->store('public/foto_diri');
        $photoPathDiri = Str::replaceFirst('public/', 'storage/', $photoPathDiri);

        $u = User::where('email', $email)->first();
        if ($u) {
            if ($u->verifyIdentitas == "Ditolak") {
                $user = $u;
                $user->verifyIdentitas = "Tidak";
            }
        } else {
            $user = new User;
        }
        $user->email = $email;
        $user->nama = $request->nama;
        $user->password = Hash::make($request->password);
        $user->no_telp = $request->nomor_telpon;
        $user->no_darurat = $request->nomor_telpon_darurat;
        $user->alamat = $request->alamat;
        $user->provinsi = $request->provinsi;
        $user->link_sosial_media = $request->link_sosial_media;
        $user->kota = $request->kota;
        $user->kode_pos = $request->kodePos;
        $user->nik = $request->nomor_identitas;
        $user->foto_identitas = $photoPath;
        $user->foto_diri = $photoPathDiri;
        $user->role = "penyewa";
        $user->save();

        $KODEOTP = KodeOTP::where('email', session('email'))->first();
        if ($KODEOTP) {
            $KODEOTP->delete();
        }

        Session::forget('verify');
        Session::forget('email');
        Session::forget('regis');
        Session::forget('role');

        return redirect()->route('loginView')->with('success', 'Registrasi berhasil dilakukan. Mohon Tunggu Konfirmasi Verifikasi Identitas 1x24 jam');
    }

    // PEMILIK SEWA

    //Masuk ke Tab Daftar Pemilik Sewa
    public function registerViewPemilikSewa(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role === "pemilik_sewa") {
                return redirect()->route('pemiliksewa.berandaView');
            } else if ($user->role === "penyewa") {
                return redirect()->route('viewHomepage');
            }
        }
        return view('authentication.register-pemiliksewa');
    }

    //Check Email Pemilik Sewa saat Regis
    public function checkEmailPemilikSewa(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'setuju_syarat_dan_ketentuan' => 'accepted',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $email = strtolower($request->email);
        $u = DB::table('users')->where('email', $email)->first();
        if ($u) {
            if ($u->verifyIdentitas == "Sudah" || $u->verifyIdentitas == "Tidak") {
                return redirect()->back()->with('error', 'Alamat Email sudah terdaftar, silahkan login atau gunakan email lain!');
            }
        }

        session(['email' => $email]);
        session(['role' => "pemilik_sewa"]);
        session(['regis' => TRUE]);

        $kode_otp = mt_rand(100000, 999999);
        while (true) {
            $cekOTP = KodeOTP::where('kode', $kode_otp)->first();
            if ($cekOTP != null) {
                dd($cekOTP);
                $kode_otp = mt_rand(100000, 999999);
            } else {
                break;
            }
        }
        // cek kode
        $cek = KodeOTP::where('email', session('email'));
        if ($cek->count() > 0) {
            $cek->update([
                'kode' => $kode_otp
            ]);
        } else {
            // create otp
            KodeOTP::create([
                'email' => session('email'),
                'kode' => $kode_otp
            ]);
        }

        try {
            Mail::to(session('email'))->send(new \App\Mail\OtpMail($kode_otp));
        } catch (Exception $e) {
            return redirect()->back()->withErrors("Kode OTP Gagal Terkirim ke Email");
        }

        return redirect()->route('verifikasiViewOTP');
    }

    //Masuk ke Halaman Daftar Pemilik Sewa Bagian Informasi
    public function registerInformationViewPemilikSewa(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();

            if (isset($user->nama)) {
                return redirect()->route('seller.berandaView');
            }
            session(['profilpath' => $user->foto_profil]);
        } else if (session()->has('regis')) {
            return view('authentication.register-pemiliksewa-informasi');
        } else {
            return redirect()->back();
        }
    }

    //Action dari Halaman Daftar Informasi Pemilik Sewa
    public function registerInformationActionPemilikSewa(Request $request)
    {
        //SIMPAN INFORMASI AKUN BARU SAAT REGISTER
        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min_digits:8,',
            'nama' => 'required|string',
            'namaToko' => 'required|string|unique:tokos,nama_toko',
            'link_sosial_media' => 'required|url',
            'nomor_telpon' => 'required|numeric|min_digits:10|max_digits:13|unique:users,no_telp',
            'AlamatToko' => 'required|string',
            'provinsi' => 'required|string',
            'kota' => 'required|in:Kota Bandung,Kabupaten Bandung',
            'kodePos' => 'required|numeric|min_digits:5|max_digits:5',
            'nomor_identitas' => 'required|numeric|min_digits:16|max_digits:16|unique:users,NIK',
            'foto_identitas' => 'image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        if (session()->has('email')) {
            $email = Session::get('email');
        } else {
            return redirect()->route('registerViewPemilikSewa')->with('error', 'Silahkan coba daftar ulang');
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $cekToko = DB::table('tokos')->where('nama_toko', $request->namaToko)->first();
        if ($cekToko !== null) {
            return redirect()->back()->withErrors(['msg' => 'Nama Toko telah ada, coba nama toko lain']);
        }

        $photoPath = $request->file('foto_identitas')->store('public/identitas');
        $photoPath = Str::replaceFirst('public/', 'storage/', $photoPath);

        $u = User::where('email', $email)->first();
        if ($u) {
            dd($u);
            if ($u->verifyIdentitas == "Ditolak") {
                $user = $u;
                $toko = DB::table('tokos')->where('id', $user->id)->first();
                dd($user, $toko);
                $user->verifyIdentitas = "Tidak";
            }
        } else {
            $user = new User;
            $toko = new Toko;
        }

        $user->email = $email;
        $user->nama = $request->nama;
        $user->password = Hash::make($request->password);
        $user->no_telp = $request->nomor_telpon;
        $user->alamat = $request->AlamatToko;
        $user->provinsi = $request->provinsi;
        $user->link_sosial_media = $request->link_sosial_media;
        $user->kota = $request->kota;
        $user->kode_pos = $request->kodePos;
        $user->nik = $request->nomor_identitas;
        $user->foto_identitas = $photoPath;
        $user->role = "pemilik_sewa";
        $user->save();
        $toko->nama_toko = $request->namaToko;
        $toko->id_user = $user->id;
        $toko->save();

        $KODEOTP = KodeOTP::where('email', session('email'))->first();
        if ($KODEOTP) {
            $KODEOTP->delete();
        }

        Session::forget('verify');
        Session::forget('email');
        Session::forget('regis');
        Session::forget('role');

        return redirect()->route('loginView')->with('success', 'Registrasi berhasil dilakukan. Mohon Tunggu Konfirmasi Verifikasi Identitas 1x24 jam');
    }


    // VERIFIKASI

    // LOGIN
    //Masuk ke Halaman Login
    public function loginView(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role === "pemilik_sewa") {
                return redirect()->route('seller.berandaView');
            } else if ($user->role === "penyewa") {
                return redirect()->route('viewHomepage');
            }
        }
        return view('authentication.login');
    }

    //Menekan Tombol Login
    public function loginAction(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $toko = Toko::where('id_user', $user->id)->first();

            if ($user->verifyIdentitas === "Tidak") {
                Auth::logout();
                Session::flush();
                Session::regenerate(true);
                return redirect()->route('loginView')->with('error', 'Mohon Tunggu Konfirmasi admin 1x24 jam');
            } else if ($user->verifyIdentitas === "Ditolak") {
                Auth::logout();
                Session::flush();
                Session::regenerate(true);
                return redirect()->route('loginView')->with('error', 'Informasi anda ditolak oleh admin! Silahkan daftar ulang');
            } else {
                session(['uid' => $user->id]);
                session(['profilpath' => $user->foto_profil]);

                if ($user->role == "pemilik_sewa") {
                    session(['namatoko' => $toko->nama_toko]);
                    return redirect()->route('seller.berandaView');
                } else if ($user->role == "penyewa") {
                    return redirect()->route('viewHomepage');
                } else if ($user->role == "admin") {
                    session(['nama' => $user->nama]);
                    return redirect()->route('admin.dashboard');
                }
            }

        } else {
            return redirect()->route('loginView')->with(['error' => 'Email atau password salah!']);
        }
    }

    // LOGOUT
    //Logout dari sesi yang sedang berlangsung
    public function logout()
    {
        if (Auth::user()) {
            Auth::logout();
            Session::flush();
            Session::regenerate(true);
            return redirect()->route('loginView');
        }
    }

    // RESET PASSWORD
    public function viewForgotPass(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role === "pemilik_sewa") {
                return redirect()->route('seller.berandaView');
            } else if ($user->role === "penyewa") {
                return redirect()->route('viewHomepage');
            }
        }
        return view('authentication.resetPassRequestEmail');
    }

    public function ForgotPassAction(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT ? back()->with(['success' => __($status)]) : back()->withErrors(['email' => __($status)]);
    }

    public function viewResetPass(Request $request, $token)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role === "pemilik_sewa") {
                return redirect()->route('seller.berandaView');
            } else if ($user->role === "penyewa") {
                return redirect()->route('viewHomepage');
            }
        }
        return view('authentication.resetPass')->with(['token' => $token, 'email' => $request->email]);
    }

    public function resetPassAction(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min_digits:8',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ]);

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET ? redirect()->route('loginView')->with('success', __($status)) :
            back()->withErrors(['email' => [__($status)]]);
    }

    // REJECTED
    public function viewRejected()
    {
        return view('authentication.infoRejected');
    }
    public function viewBanned()
    {
        return view('authentication.infoBanned');
    }

    // BANNED
}