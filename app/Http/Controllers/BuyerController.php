<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Toko;
use App\Models\User;
use App\Models\Penyewa;
use App\Models\Produk;
use App\Models\FotoProduk;
use App\Models\Series;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Collection;

class BuyerController extends Controller
{
    public function viewHomepage(Request $request) {
        $produk = Produk::all();
        $fotoproduk = FotoProduk::all();
        $toko = Toko::all();
        $user = User::all();
        $series = Series::all();
        $brand = Produk::select('brand')->distinct()->get();
        return view('homepage', compact('produk', 'fotoproduk', 'toko', 'user', 'series', 'brand'));
    }

    public function viewSeries(Request $request) {
        $produk = Produk::all();
        $fotoproduk = FotoProduk::all();
        $toko = Toko::all();
        $user = User::all();
        $series = Series::all();
        $brand = Produk::select('brand')->distinct()->get();
        return view('series', compact('produk', 'fotoproduk', 'toko', 'user', 'series', 'brand'));
    }

    public function viewBrand(Request $request) {
        $produk = Produk::all();
        $fotoproduk = FotoProduk::all();
        $toko = Toko::all();
        $user = User::all();
        $series = Series::all();
        $brand = Produk::select('brand')->distinct()->get();
        return view('brand', compact('produk', 'fotoproduk', 'toko', 'user', 'series', 'brand'));
    }

    public function viewDetail($id) {
        $produk = Produk::findOrFail($id);
        $fotoproduk = FotoProduk::where('ID_produk', $id)->get();
        $toko = Toko::where('id', $produk->id_toko)->first();
        $user = User::where('id', $toko->id_user)->first();
        $series = Series::all();
        $brand = Produk::select('brand')->distinct()->get();
    
        return view('user.detail', compact('produk', 'fotoproduk', 'toko', 'user', 'series', 'brand'));
    }

    public function viewProfile($id) {
        $user = User::findOrFail($id);
        return view('user.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        // Validasi data input
        $request->validate([
            'nama' => 'required|string|max:255',
            'noTelp' => 'required|string|min:10|max:14|regex:/[0-9]/',
            'identitas' => 'nullable|file|mimes:jpg,png|max:2048',
            'alamat' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
            'kodePos' => 'required|string|min:5|max:6|regex:/[0-9]/'
        ]);

        // Ambil user yang sedang login
        $user = auth()->user();

        // Perbarui data user
        $user->nama = $request->input('nama');
        $user->no_telp = $request->input('noTelp');
        $user->alamat = $request->input('alamat');
        $user->provinsi = $request->input('provinsi');
        $user->kota = $request->input('kota');
        $user->kode_pos = $request->input('kodePos');

        // Cek jika ada file identitas yang diunggah
        if ($request->hasFile('identitas')) {
            $file = $request->file('identitas');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/identitas'), $filename);
            $user->identitas = $filename;
        }
        
        $user->save();

        // Redirect ke halaman profil dengan pesan sukses
        return redirect()->route('viewProfile', ['id' => $user->id])->with('success', 'Profil berhasil diperbarui');
    }

    public function viewGantiPassword($id) {
        $user = User::findOrFail($id);
        return view('user.changepassword', compact('user'));
    }

    public function updatePassword(Request $request)
    {
        // Validasi data input
        $request->validate([
            'password' => 'required|string',
            'newPassword' => 'required|string|min:8',
            'confNewPassword' => 'required|string|min:8|same:newPassword', // Menambahkan aturan untuk memastikan konfirmasi password baru cocok dengan password baru
        ]);

        // Ambil user yang sedang login
        $user = auth()->user();

        // Periksa apakah password lama yang dimasukkan oleh pengguna cocok dengan password yang disimpan dalam basis data
        if (!Hash::check($request->input('password'), $user->password)) {
            // Password lama tidak cocok, kembalikan dengan pesan kesalahan
            return redirect()->back()->withErrors(['password' => 'Password lama tidak sesuai']);
        }

        // Jika password lama sesuai, perbarui data user dengan password baru
        $user->password = Hash::make($request->input('newPassword'));

        $user->save();

        // Redirect ke halaman profil dengan pesan sukses
        return redirect()->route('viewGantiPassword', ['id' => $user->id])->with('success', 'Profil berhasil diperbarui');
}
    

}
