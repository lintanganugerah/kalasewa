<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Toko;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class AutentikasiController extends Controller
{
    public function loginView(Request $request) {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role === "pemilik_sewa") {
                return redirect()->route('seller.berandaView');
            } elseif ($user->role === "admin") {
                return redirect()->route('admin.dashboard');
            }
        }
        return view('autentikasi.login');
    }

    public function loginAction(Request $request)
    {
        $credentials = $request->only('email', 'password');
        Session::forget('Invalid_Identitas');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $user_id = $user->id;
            $toko = Toko::where('ID_User', $user->id)->first();

            if (!isset($user->email_verified_at)) {
                session(['verify' => TRUE]);
                session(['email' => $user->email]);
                $user->sendEmailVerificationNotification();
                Auth::logout();
                return redirect()->route('seller.verifikasiView');
            } else if($user->verifyIdentitas === "Tidak") {
                Auth::logout();
                Session::flush();
                Session::regenerate(true);
                return redirect()->route('loginView')->with('error', 'Mohon Tunggu Konfirmasi admin 1x24 jam');
            } else if($user->verifyIdentitas === "Ditolak") {
                Auth::logout();
                Session::flush();
                Session::regenerate(true);
                session(['user_ID' => $user_id]);
                session(['Invalid_Identitas' => TRUE]);
                return redirect()->route('loginView')->with('error', 'Informasi anda ditolak oleh admin');
            }

            session(['uid' => $user->id]);
            session(['nama' => $user->nama]);


            if ($user->role == "pemilik_sewa") {
                session(['profilpath' => $user->foto_profil]);
                session(['namatoko' => $toko->nama_toko]);
                return redirect()->route('seller.berandaView');
            } else if ($user->role == "penyewa") {
                return redirect()->route('');
            } else if ($user->role == "admin") {
                return redirect()->route('admin.dashboard');
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

    public function viewForgotPass(Request $request) {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role === "pemilik_sewa") {
                return redirect()->route('seller.berandaView');
            }
        }
        return view('autentikasi-seller.resetPassRequestEmail');
    }

    public function ForgotPassAction(Request $request) {
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

    public function viewresetPass(Request $request, $token) {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role === "pemilik_sewa") {
                return redirect()->route('seller.berandaView');
            }
        }
        return view('autentikasi-seller.resetPass')->with(['token' => $token, 'email' => $request->email]);
    }

    public function resetPassAction(Request $request) {
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
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

    public function registerViewBuyer(Request $request) {
        return view('autentikasi-seller.daftar-buyer');
    }

    public function registerView(Request $request) {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role === "pemilik_sewa") {
                return redirect()->route('seller.berandaView');
            }
        }
        return view('autentikasi-seller.daftar-seller');
    }
}