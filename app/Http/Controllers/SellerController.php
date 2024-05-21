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

class SellerController extends Controller
{
    public function sellerBerandaView(Request $request) {
        $user = Auth::user();

        if (!isset($user->nama)) {
            return redirect()->route('seller.registerInformationView');
        } else if (!isset($user->identitas) && $user->verifyIdentitas === 'Tidak') {
            session(['Isi_Identitas' => "Mohon Isi Identitas Anda untuk dapat mulai berjualan"]);
            session(['regisIdentitas' => TRUE]);
            return view('beranda');
        } else if (isset($user->identitas) && $user->verifyIdentitas === 'Tidak') {
            session(['Menunggu_Identitas' => "Identitas Anda sedang menunggu konfirmasi Admin! Mohon tunggu 1x24 jam"]);
            return view('beranda');
        } else if ($user->verifyIdentitas === "Ditolak") {
            if(session()->has('Menunggu_Identitas')) {
                Session::forget('Menunggu_Identitas');
                Session::forget('Isi_Identitas');
            }
            session(['regisIdentitas' => TRUE]);
            session(['Invalid_Identitas' => "Identitas anda ditolak oleh admin"]);
            
            return view('beranda');
        }else if ($user->verifyIdentitas === "Sudah") {
            Session::forget('Menunggu_Identitas');
            Session::forget('Isi_Identitas');
            Session::forget('Invalid_Identitas');

            return view('beranda');
        }
        return view('beranda');
    }

    public function regisIdentitasView(Request $request) {
        if (!session()->has('regisIdentitas')) {
            return redirect()->back();
        }

        $user = Auth::user();

        return view('autentikasi-seller.regisIdentitas')->with('nama', $user->nama);
    }

    public function profilTokoView(Request $request) {
        $user = Auth::user();
        $toko = Toko::where('ID_user', $user->id)->first();
        $decodeToko = json_decode($toko->metode_kirim);
        return view('profiltoko', compact('user', 'toko', 'decodeToko'));
    }

    public function profilTokoAction(Request $request) {
        $user = Auth::user();
        $toko = Toko::where('ID_user', $user->id)->first();

        $validator = Validator::make( $request->all (), [
            'nama' => 'required|string',
            'namaToko' => 'required|string',
            'noTelp' => 'required|numeric|digits_between:10,14',
            'AlamatToko' => 'required|string',
            'kota' => 'required|in:Kota Bandung,Kabupaten Bandung',
            'kodePos' => 'required|numeric|digits_between:5,6',
            'metode_kirim' => 'required|array',
            'foto' => 'file|mimes:jpeg,png|max:5120',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $fotoPath = $user->foto_profil;
        $namaFile = basename($fotoPath);
        
        if ($request->has('foto')) {
            if ($namaFile !== 'profil_default.jpg') {
                Storage::delete(str_replace('storage/', 'public/', $fotoPath));
            }
            $photoPath = $request->file('foto')->store('public/profiles');
            $photoPath = Str::replaceFirst('public/', 'storage/', $photoPath);
            $user->foto_profil = $photoPath;
            $user->save();
        }

        $user->no_telp = $request->noTelp;
        $user->alamat = $request->AlamatToko;
        $user->kota = $request->kota;
        $user->kode_pos = $request->kodePos;
        $user->nama = $request->nama;
        $toko->nama_toko = $request->namaToko;
        $toko->metode_kirim = json_encode($request->metode_kirim);
        $user->save();
        $toko->save();

        session(['uid' => $user->id]);
        session(['namatoko' => $toko->nama_toko]);
        session(['profilpath' => $user->foto_profil]);

        return redirect()->route('seller.profilTokoView')->with('success', 'Profil Berhasil Di ubah');
    }

    public function identitasAction(Request $request) {
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'NIK' => 'required|numeric|digits_between:16,16|unique:users,NIK',
            'photo' => 'mimes:jpg,png,jpeg|max:512',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($user->verifyIdentitas == "Ditolak") {
            $user->verifyIdentitas = "Tidak";
            $user->save();
        }

        $photoPath = $request->file('identitas')->store('public/data');
        $photoPath = Str::replaceFirst('data/', 'storage/', $photoPath);

        $user->nik = $request->NIK;
        $user->identitas = $photoPath;
        $user->save();

        Session::forget('Isi_Identitas');
        Session::forget('Menunggu_Identitas');
        Session::forget('Invalid_Identitas');

        return redirect()->route('seller.berandaView')->with('success', 'Identitas Anda berhasil disimpan');
    }
}
