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

class AutentikasiSellerController extends Controller
{

    public function registerView(Request $request) {
        return view('autentikasi-seller.daftar-seller');
    }

    public function registerInformationView(Request $request) {
        if (session('role') === "pemilik_sewa") {
            return redirect()->route('seller.berandaView');
        }
        return view('autentikasi-seller.daftar-informasi-seller');
    }

    public function loginView(Request $request) {
        if (session('role') === "pemilik_sewa") {
            return redirect()->route('seller.berandaView');
        }
        return view('autentikasi-seller.login-seller');
    }

    public function verifikasiView(Request $request) {
        if (!session()->has('regis')) {
            return redirect()->back();
        }
        return view('autentikasi-seller.daftar-kode-verifikasi');
    }

    public function registerInformationAction(Request $request) {
        $user = Auth::user();
        if (!isset($user->nama)) {
            $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'namaToko' => 'required|string',
            'noTelp' => 'required|numeric',
            'AlamatToko' => 'required|string',
            'provinsi' => 'required|string',
            'kota' => 'required|in:Kota Bandung,Kabupaten Bandung',
            'kodePos' => 'required|numeric',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            
            $cekToko = DB::table('tokos')->where('nama_toko',$request->namaToko)->first();
            if ($cekToko !== null) {
                return redirect()->back()->withErrors(['msg' => 'Nama Toko telah ada, coba nama toko lain']);
            }
            
            $photoPath = $request->file('identitas')->store('public/data');
            $photoPath = Str::replaceFirst('data/', 'storage/', $photoPath);
            dd($photoPath);

            $toko = new Toko;
            $user->nama = $request->nama;
            $user->no_telp = $request->noTelp;
            $user->alamat = $request->AlamatToko;
            $user->provinsi = $request->provinsi;
            $user->kota = $request->kota;
            $user->kode_pos = $request->kodePos;
            $user->identitas = $photoPath;
            $toko->nama_toko = $request->namaToko;
            $toko->ID_user = $user->id;
            $user->save();
            $toko->save();

            return redirect()->route('seller.berandaView');
        }
    }

    public function registerFirstStage(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $email = strtolower($request->email);
        $u = DB::table('users')->where('email',$email)->first();
        if($u){
            return redirect()->route('seller.registerView')->with('error', 'Alamat Email sudah terdaftar, coba alamat email lain!');
        }
        $user = new User;
        $user->email = $email;
        $user->password = Hash::make($request->password);
        $user->role = "pemilik_sewa";
        $user->save();
        $user->sendEmailVerificationNotification();
        session(['regis' => TRUE]);
        return redirect()->route('seller.verifikasiView')->with('emailRegis', $email);
    }

    public function verify(Request $request,$user_id,$hash) {
        if (!$request->hasValidSignature()) {
            return response()->json(["msg" => "Invalid/Expired url provided."], 401);
        }

        $user = User::findOrFail($user_id);
    
        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
            Auth::loginUsingId($user_id);
        } else {
            return redirect()->route('seller.registerView')->with("error", "User Telah terverifikasi, Silahkan Login");
        }
    
        return redirect()->route('seller.registerInformationView');
    }

    public function loginAction(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $toko = Toko::where('ID_User', $user->id)->first();

            session(['loggedin' => TRUE]);
            session(['uid' => $user->id]);
            session(['profilpath' => $user->foto_profil]);
            session(['namatoko' => $toko->nama_toko]);

            if ($user->role == "pemilik_sewa") {
                return redirect()->route('seller.berandaView');
            }
        } else {
            return redirect()->route('seller.loginView')->with(['error' => 'Email atau password salah!']);
        }
    }

    public function logout()
    {
        if (Auth::user()) {
            Auth::logout();
            Session::flush();
            Session::regenerate(true);
            return redirect()->route('seller.loginView');
        }
    }
}
