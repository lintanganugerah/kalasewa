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
    public function jadiSellerView(Request $request)
    {
        return view('jadiseller');
    }

    public function sellerBerandaView(Request $request)
    {
        return view('beranda');
    }

    public function testView()
    {
        return view('tes');
    }

    public function profilTokoView(Request $request)
    {
        $user = Auth::user();
        $toko = Toko::where('id_user', $user->id)->first();
        $decodeKirim = json_decode($toko->metode_kirim);
        return view('profiltoko', compact('user', 'toko', 'decodeKirim'));
    }

    public function profilTokoAction(Request $request)
    {
        $user = Auth::user();
        $toko = Toko::where('id_user', $user->id)->first();

        $validator = Validator::make($request->all(), [
            'namaToko' => 'required|string',
            'link_sosial_media' => 'required|url',
            'nomor_telpon' => 'required|numeric|min_digits:10|max_digits:13',
            'AlamatToko' => 'required|string',
            'kota' => 'required|in:Kota Bandung,Kabupaten Bandung',
            'provinsi' => 'required|in:Jawa Barat',
            'kodePos' => 'required|numeric|min_digits:5|max_digits:5',
            'foto' => 'file|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $cekToko = DB::table('tokos')->where('nama_toko', $request->namaToko)->first();
        if ($cekToko && $cekToko->id_user != $user->id) {
            return redirect()->back()->withErrors(['msg' => 'Nama Toko telah ada, coba nama toko lain']);
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

        if ($request->has('bio_toko')) {
            $toko->bio_toko = $request->bio_toko;
        }

        $user->no_telp = $request->nomor_telpon;
        $user->alamat = $request->AlamatToko;
        $user->kota = $request->kota;
        $user->kode_pos = $request->kodePos;
        $user->link_sosial_media = $request->link_sosial_media;
        $toko->nama_toko = $request->namaToko;
        $user->save();
        $toko->save();

        session(['uid' => $user->id]);
        session(['namatoko' => $toko->nama_toko]);
        session(['profilpath' => $user->foto_profil]);

        return redirect()->route('seller.profilTokoView')->with('success', 'Profil Berhasil Di ubah');
    }
}