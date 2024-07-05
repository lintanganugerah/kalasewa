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
use App\Models\Review;
use App\Models\PeraturanSewa;
use App\Models\OrderPenyewaan;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Collection;

class HistoryController extends Controller
{
    public function viewHistory()
    {
        $user = Auth::user(); // Mendapatkan user yang sedang login
        $orders = OrderPenyewaan::where('id_penyewa', $user->id)->get(); // Mengambil order berdasarkan id_penyewa

        // Ambil nama produk dan foto produk untuk setiap order
        foreach ($orders as $order) {
            $produk = Produk::findOrFail($order->id_produk);
            $order->nama_produk = $produk->nama_produk; // Tambahkan kolom nama_produk ke dalam objek order
            $order->foto_produk = $produk->FotoProduk->path; // Tambahkan kolom foto_produk ke dalam objek order
        }

        // Pastikan additional adalah string sebelum memanggil json_decode
        if (!is_array($order->additional)) {
            $order->additional = json_decode($order->additional, true);
        }

        return view('penyewa.history.semua', compact('user', 'orders'));
    }

    public function viewHistoryOngoing()
    {
        $user = Auth::user(); // Mendapatkan user yang sedang login
        $orders = OrderPenyewaan::where('id_penyewa', $user->id)->get(); // Mengambil order berdasarkan id_penyewa

        // Ambil nama produk dan foto produk untuk setiap order
        foreach ($orders as $order) {
            $produk = Produk::findOrFail($order->id_produk);
            $order->nama_produk = $produk->nama_produk; // Tambahkan kolom nama_produk ke dalam objek order
            $order->foto_produk = $produk->FotoProduk->path; // Tambahkan kolom foto_produk ke dalam objek order
        }

        // Pastikan additional adalah string sebelum memanggil json_decode
        if (!is_array($order->additional)) {
            $order->additional = json_decode($order->additional, true);
        }

        return view('penyewa.history.onGoing', compact('user', 'orders'));
    }

    public function viewHistoryFinish()
    {
        $user = Auth::user(); // Mendapatkan user yang sedang login
        $orders = OrderPenyewaan::where('id_penyewa', $user->id)->get(); // Mengambil order berdasarkan id_penyewa

        // Ambil nama produk dan foto produk untuk setiap order
        foreach ($orders as $order) {
            $produk = Produk::findOrFail($order->id_produk);
            $order->nama_produk = $produk->nama_produk; // Tambahkan kolom nama_produk ke dalam objek order
            $order->foto_produk = $produk->FotoProduk->path; // Tambahkan kolom foto_produk ke dalam objek order
        }

        // Pastikan additional adalah string sebelum memanggil json_decode
        if (!is_array($order->additional)) {
            $order->additional = json_decode($order->additional, true);
        }

        return view('penyewa.history.selesai', compact('user', 'orders'));
    }
}