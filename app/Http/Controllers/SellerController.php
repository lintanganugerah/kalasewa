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
        }
        return view('beranda');
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
            'namaToko' => 'required|string',
            'noTelp' => 'required|numeric|digits_between:10,14',
            'AlamatToko' => 'required|string',
            'kota' => 'required|in:Kota Bandung,Kabupaten Bandung',
            'kodePos' => 'required|numeric|digits_between:5,6',
            'metode_kirim' => 'required|array',
            'foto' => 'nullable|file|mimes:jpeg,png|max:5120',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $fotoPath = $user->foto_profil;
        $namaFile = basename($fotoPath);
        
        if ($namaFile !== 'profil_default.jpg') {
            Storage::delete(str_replace('storage/', 'public/', $fotoPath));
        }
        
        if ($request->has('foto')) {
            $photoPath = $request->file('foto')->store('public/profiles');
            $photoPath = Str::replaceFirst('public/', 'storage/', $photoPath);
            $user->foto_profil = $photoPath;
            $user->save();
        }

        $user->no_telp = $request->noTelp;
        $user->alamat = $request->AlamatToko;
        $user->kota = $request->kota;
        $user->kode_pos = $request->kodePos;
        $toko->nama_toko = $request->namaToko;
        $toko->metode_kirim = json_encode($request->metode_kirim);
        $user->save();
        $toko->save();

        session(['loggedin' => TRUE]);
        session(['uid' => $user->id]);
        session(['profilpath' => $user->foto_profil]);
        session(['namatoko' => $toko->nama_toko]);

        return redirect()->route('seller.profilTokoView')->with('success', 'Profil Berhasil Di ubah');
    }
}
