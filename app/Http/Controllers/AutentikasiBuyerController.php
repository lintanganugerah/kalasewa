<?php

namespace App\Http\Controllers;

use App\Models\Toko;
use App\Models\User;
use App\Models\Penyewa;
use App\Models\Produk;
use App\Models\FotoProduk;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AutentikasiBuyerController extends Controller
{

    public function registerView(Request $request) { //View Masuk register secara default ke seller
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role === "pemilik_sewa") {
                return redirect()->route('seller.berandaView');
            }
            else if ($user->role === "penyewa") {
                return redirect()->route('homepage');
            }
        }
        return view('auth.daftar-seller');
    }

    public function registerViewBuyer(Request $request) { //Ini pindah dari navtabs nya buat regis sbg buyer
        return view('auth.daftar-buyer');
    }

    public function registerInformationView(Request $request) { //uat nampilin UI isi form informasi akun
        if (Session() -> has ("email")){
            return view('auth.daftar-informasi-buyer');
        }
    }

    public function loginView(Request $request) { // Buat nampilin UI login penyewa atau pemilik sewa
        if (Auth::check()) { // sama juga cek udah login apa belom, kalo udah bakal ke mana
            $user = Auth::user();
            if ($user->role === "pemilik_sewa") {
                return redirect()->route('seller.berandaView');
            } else if ($user->role === "penyewa") {
                return view('homepage');
            }
            
        }
        return view('auth.login');
    }

    public function verifikasiView(Request $request) { // Buat nampilin UI halaman untuk cek email
        // if (!session()->has('verify')) {
        //     return redirect()->back();
        // } elseif (session()->has('verified')) {
        //     return redirect()->route('seller.verifiedView');
        // }
        return view('auth.daftar-kode-verifikasi');
    }

    public function verifiedView(Request $request) { // Nampilin halaman dari link verifikasi bahwa sudah terverified, disuruh utk login
        // if (!session()->has('verified')) {
        //     return redirect()->route('loginView');
        // }
        Session::forget('verified');
        return view('auth.daftar-verified-view');
    }

    public function registerInformationAction(Request $request) {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'password' => 'required|string',
            'nama' => 'required|string',
            'nik' => 'required|numeric|digits:16|unique:users,nik',
            'identitas' => 'required|mimes:jpg,png,jpeg|max:5120',
            'noTelp' => 'required|numeric|digits_between:10,14|unique:users,no_telp',
            'alamat' => 'required|string',
            'provinsi' => 'required|string',
            'kota' => 'required|in:Kota Bandung,Kabupaten Bandung',
            'kodePos' => 'required|numeric|digits_between:5,6',
        ]);
    
        // Check if email exists in the session
        if (session()->has('email')) {
            $email = session('email');
        } else {
            return redirect()->route('buyer.registerViewBuyer')->with('error', 'Silahkan daftar ulang.');
        }
    
        // Handle validation errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Store the identitas file
        $photoPath = $request->file('identitas')->store('public/data');
        $photoPath = Str::replaceFirst('public/', 'storage/', $photoPath);
    
        // Create a new User instance and save data
        $user = new User();
        $user->email = $email;
        $user->nama = $request->nama;
        $user->password = Hash::make($request->password);
        $user->nik = $request->nik;
        $user->identitas = $photoPath;
        $user->no_telp = $request->noTelp;
        $user->alamat = $request->alamat;
        $user->provinsi = $request->provinsi;
        $user->kota = $request->kota;
        $user->kode_pos = $request->kodePos;
        $user->save();
        $user->sendEmailVerificationNotification();
        session(['verify' => TRUE]);
    
        // Redirect to verification view
        return redirect()->route('buyer.verifikasiView');
    }

    public function registerActionBuyer(Request $request) { //Register pas di klik button submitnya
        $request->validate([
            'email' => 'required|email|unique:users,email',
        ]);
        $email = strtolower($request->email);
        $u = DB::table('users')->where('email',$email)->first();
        if($u){
            return redirect()->back()->with('error', 'Alamat Email sudah terdaftar, silahkan login atau gunakan email lain!');
        }
        Session::put('email', $email);
        return redirect()->route('buyer.registerInformationView');
    }

    public function verify(Request $request,$user_id,$hash) { //BUAT VERIFIKASI DARI LINK YANG ADA DI EMAIL
        if (!$request->hasValidSignature()) {
            return response()->json(["msg" => "Invalid/Expired url provided."], 401);
        }

        Session::forget('verify');
        session(['verified' => TRUE]);
        Session::forget('email');

        if(!Auth::check()) {
            $user = User::findOrFail($user_id);
        } else {
            $user = Auth::user();
        }
    
        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified(); //INI PENTING BUAT VERIFIKASI EMAIL SETELAH KLIK LINK YANG ADA DI EMAIL
        } else {
            return redirect()->route('seller.registerView')->with("error", "User Telah terverifikasi, Silahkan Login");
        }

        Auth::logout();
    
        return redirect()->route('buyer.verifiedView');
    }

    public function loginAction(Request $request) //Klik login dari halaman login
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $penyewa = User::where('id', $user->id)->first();

            if (!isset($user->email_verified_at)) {
                session(['verify' => TRUE]);
                session(['emailRegis' => $user->email]);
                $user->sendEmailVerificationNotification();
                Auth::logout();
                return redirect()->route('viewHomepage');
            } else if(!isset($user->nama)) {
                return redirect()->route('seller.registerInformationView');
            }
            
            session(['uid' => $user->id]);
            session(['profilpath' => $user->foto_profil]);


            if ($user->role == "pemilik_sewa") {
                return redirect()->route('seller.berandaView');
            } else if ($user->role == "penyewa") {
                return redirect()->route('viewHomepage');
            }
        } else {
            return redirect()->route('loginView')->with(['error' => 'Email atau password salah!']);
        }
    }

    public function logout()
    {
        if (Auth::user()) {
            Auth::logout();
            Session::flush();
            Session::regenerate(true);
            return redirect()->route('loginView');
        }
    }

    public function search(Request $request)
    {
        $query = $request->input('search');
        $size = $request->input('size');

        $products = Produk::query();

        if ($query) {
            $products = $products->where('nama_produk', 'LIKE', "%{$query}%")
                                  ->orWhere('kategori', 'LIKE', "%{$query}%");
        }

        if ($size) {
            $products = $products->whereJsonContains('ukuran_produk', $size);
        }

        $products = $products->get();
        
        $fotoproduk = Fotoproduk::all();
        $toko = Toko::all();
        $user = User::all();

        return view('homepage', [
            'produk' => $products,
            'fotoproduk' => $fotoproduk,
            'toko' => $toko,
            'user' => $user
        ]);
    } 
}
