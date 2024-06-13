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
use App\Models\Penyewa;
use App\Models\Produk;
use App\Models\FotoProduk;
use App\Models\Series;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Collection;

class PenyewaController extends Controller
{

    // MANAJEMEN PROFIL VIEW
    public function viewProfile($id)
    {
        $user = User::findOrFail($id);
        return view('penyewa.profile', compact('user'));
    }

    // MANAJEMEN PROFIL ACTION
    public function updateProfile(Request $request)
    {
        // Validasi data input
        $request->validate([
            'nomor_telpon' => 'required|numeric|min_digits:10|max_digits:13|unique:users,no_telp',
            'nomor_telpon_darurat' => 'required|numeric|min_digits:10|max_digits:13',
            'link_sosial_media' => 'required|url',
            'alamat' => 'required|string',
            'provinsi' => 'required|string',
            'kota' => 'required|in:Kota Bandung,Kabupaten Bandung',
            'kodePos' => 'required|numeric|min_digits:5|max_digits:5',
        ]);

        // Ambil user yang sedang login
        $user = auth()->user();

        // Perbarui data user
        $user->no_telp = $request->input('nomor_telpon');
        $user->no_darurat = $request->input('nomor_telpon_darurat');
        $user->alamat = $request->input('alamat');
        $user->provinsi = $request->input('provinsi');
        $user->link_sosial_media = $request->input('link_sosial_media');
        $user->kota = $request->input('kota');
        $user->kode_pos = $request->input('kodePos');
        $user->save();

        // Redirect ke halaman profil dengan pesan sukses
        return redirect()->route('viewProfile', ['id' => $user->id])->with('success', 'Profil berhasil diperbarui');
    }

    // MANAJEMEN PASSWORD VIEW
    public function viewGantiPassword($id)
    {
        $user = User::findOrFail($id);
        return view('penyewa.changepassword', compact('user'));
    }

    // MANAJEMEN PASSWORD ACTION
    public function updatePassword(Request $request)
    {
        // Validasi data input
        $request->validate([
            'password' => 'required|string',
            'newPassword' => 'required|string|min:8',
            'confNewPassword' => 'required|string|min:8', // Menambahkan aturan untuk memastikan konfirmasi password baru cocok dengan password baru
        ]);


        // Ambil user yang sedang login
        $user = auth()->user();

        // Periksa apakah password lama yang dimasukkan oleh pengguna cocok dengan password yang disimpan dalam basis data
        if (!Hash::check($request->input('password'), $user->password)) {
            // Password lama tidak cocok, kembalikan dengan pesan kesalahan
            return redirect()->route('viewGantiPassword', ['id' => $user->id])->with('error', 'Error! Password Lama Salah!');
        }

        if ($request->input('newPassword') != $request->input('confNewPassword')) {
            return redirect()->route('viewGantiPassword', ['id' => $user->id])->with('error', 'Error! Konfirmasi Password Baru Salah!');
        }

        // Jika password lama sesuai, perbarui data user dengan password baru
        $user->password = Hash::make($request->input('newPassword'));

        $user->save();

        // Redirect ke halaman profil dengan pesan sukses
        return redirect()->route('viewGantiPassword', ['id' => $user->id])->with('success', 'Password Berhasil Diganti!');
    }

}