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
        $user = Auth::user(); // Get the currently logged in user
        $orders = OrderPenyewaan::where('id_penyewa', $user->id)->orderBy("updated_at", "desc")->get(); // Retrieve orders based on id_penyewa

        if ($orders) {
            // Iterate over each order to get product details
            foreach ($orders as $order) {
                $produk = Produk::withTrashed()->findOrFail($order->id_produk);
                $order->nama_produk = $produk->nama_produk; // Add nama_produk column to the order object
                $order->foto_produk = $produk->FotoProduk->path ? $produk->FotoProduk->path : 'storage/placeholderSeeder/no_image_placeholder.jpg'; // Add foto_produk column to the order object

                // Ensure additional is a string before calling json_decode
                if (!is_array($order->additional)) {
                    $order->additional = json_decode($order->additional, true);
                }
            }
        }

        return view('penyewa.history.semua', compact('user', 'orders'));
    }

    public function viewHistoryOngoing()
    {
        $user = Auth::user(); // Mendapatkan user yang sedang login
        $orders = OrderPenyewaan::where('id_penyewa', $user->id)->orderBy("updated_at", "asc")->get(); // Mengambil order berdasarkan id_penyewa

        if ($orders) {
            // Ambil nama produk dan foto produk untuk setiap order
            foreach ($orders as $order) {
                $produk = Produk::withTrashed()->findOrFail($order->id_produk);
                $order->nama_produk = $produk->nama_produk; // Tambahkan kolom nama_produk ke dalam objek order
                $order->foto_produk = $produk->FotoProduk->path ? $produk->FotoProduk->path : 'storage/placeholderSeeder/no_image_placeholder.jpg'; // Tambahkan kolom foto_produk ke dalam objek order
                if (!is_array($order->additional)) {
                    $order->additional = json_decode($order->additional, true);
                }
            }
        }

        // Pastikan additional adalah string sebelum memanggil json_decode


        return view('penyewa.history.onGoing', compact('user', 'orders'));
    }

    public function viewHistoryFinish()
    {
        $user = Auth::user(); // Mendapatkan user yang sedang login
        $orders = OrderPenyewaan::where('id_penyewa', $user->id)->orderBy("updated_at", "asc")->get(); // Mengambil order berdasarkan id_penyewa

        if ($orders) {
            // Ambil nama produk dan foto produk untuk setiap order
            foreach ($orders as $order) {
                $produk = Produk::withTrashed()->findOrFail($order->id_produk);
                $order->nama_produk = $produk->nama_produk; // Tambahkan kolom nama_produk ke dalam objek order
                $order->foto_produk = $produk->FotoProduk->path ? $produk->FotoProduk->path : 'storage/placeholderSeeder/no_image_placeholder.jpg'; // Tambahkan kolom foto_produk ke dalam objek order
                // Pastikan additional adalah string sebelum memanggil json_decode
                if (!is_array($order->additional)) {
                    $order->additional = json_decode($order->additional, true);
                }
            }
        }


        return view('penyewa.history.selesai', compact('user', 'orders'));
    }
}