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
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Collection;

class PublicController extends Controller
{

    // MARKETPLACE HOMEPAGE
    public function viewHomepage(Request $request)
    {
        // Ambil semua nilai unik brand, tanpa memandang status produk
        $brand = Produk::select('brand')->distinct()->orderBy('brand', 'asc')->pluck('brand');

        // Ambil produk dengan status 'aktif'
        $produkQuery = Produk::where('status_produk', 'aktif');

        // Terapkan filter jika ada
        if ($request->has('brand')) {
            $produkQuery->where('brand', $request->brand);
        }
        $produk = $produkQuery->get();

        // Ambil semua foto produk, toko, dan pengguna
        $fotoproduk = FotoProduk::all();
        $toko = Toko::withCount('produks')->take(5)->get(); // <-- tambahkan take(5) jika ingin membatasi hasil
        $user = User::all();

        // Ambil semua series dan urutkan secara abjad
        $series = Series::orderBy('series', 'asc')->get();
        /* dd(session('profilpath')); */
        return view('homepage', compact('produk', 'fotoproduk', 'toko', 'user', 'series', 'brand'));
    }

    // MARKETPLACE SERIES
    public function viewSeries(Request $request)
    {
        // Ambil semua series dan urutkan berdasarkan nama
        $series = Series::orderBy('series')->get();

        // Kelompokkan series berdasarkan huruf pertama
        $groupedSeries = $series->groupBy(function ($item) {
            return strtoupper(substr($item->series, 0, 1));
        });

        return view('series', compact('groupedSeries'));
    }

    // MARKETPLACE DETAIL
    public function viewDetail($id)
    {
        $produk = Produk::with('toko.user')->findOrFail($id);
        $fotoproduk = FotoProduk::where('ID_produk', $id)->get();
        $series = Series::all();
        $brand = Produk::select('brand')->distinct()->get();
        $toko = Toko::all();
        $review = Review::where('id_produk', $id)->with('user')->get();
        $aturan = PeraturanSewa::where('id_toko', $produk->toko->id)->get();

        // Hitung rata-rata nilai review produk
        $averageRating = Review::where('id_produk', $id)->avg('nilai');

        // Hitung rata-rata nilai review toko
        $averageTokoRating = Review::where('id_toko', $produk->toko->id)->avg('nilai');

        return view('detail', compact('produk', 'fotoproduk', 'series', 'brand', 'toko', 'review', 'averageRating', 'averageTokoRating', 'aturan'));
    }

    public function viewListToko(Request $request)
    {
        // Ambil semua nilai unik brand, tanpa memandang status produk
        $brand = Produk::select('brand')->distinct()->orderBy('brand', 'asc')->pluck('brand');

        // Ambil produk dengan status 'aktif'
        $produkQuery = Produk::where('status_produk', 'aktif');

        // Terapkan filter jika ada
        if ($request->has('brand')) {
            $produkQuery->where('brand', $request->brand);
        }
        $produk = $produkQuery->get();

        // Ambil semua foto produk, toko, dan pengguna
        $fotoproduk = FotoProduk::all();
        $toko = Toko::withCount('produks')->get();
        $user = User::all();

        // Ambil semua series dan urutkan secara abjad
        $series = Series::orderBy('series', 'asc')->get();
        /* dd(session('profilpath')); */
        return view('listToko', compact('produk', 'fotoproduk', 'toko', 'user', 'series', 'brand'));
    }

    public function viewToko(Request $request, $id)
    {
        $toko = Toko::findOrFail($id);

        // Ambil semua nilai unik brand, tanpa memandang status produk
        $brand = Produk::select('brand')->distinct()->orderBy('brand', 'asc')->pluck('brand');

        // Ambil produk dengan status 'aktif' dan milik toko yang bersangkutan
        $produkQuery = Produk::where('status_produk', 'aktif')->where('id_toko', $id);

        // Terapkan filter jika ada
        if ($request->has('brand')) {
            $produkQuery->where('brand', $request->brand);
        }
        $produk = $produkQuery->get();

        // Ambil semua foto produk, toko, dan pengguna
        $fotoproduk = FotoProduk::all();
        $user = User::all();

        // Ambil semua series dan urutkan secara abjad
        $series = Series::orderBy('series', 'asc')->get();

        $review = Review::where('id_toko', $id)->get();

        // Hitung rata-rata nilai review toko
        $averageTokoRating = Review::where('id_toko', $id)->avg('nilai');

        return view('viewToko', compact('produk', 'fotoproduk', 'toko', 'user', 'series', 'brand', 'review', 'averageTokoRating'));
    }

    public function searchProdukToko(Request $request, $id)
    {
        $toko = Toko::findOrFail($id);
        $brand = Produk::select('brand')->distinct()->orderBy('brand', 'asc')->pluck('brand');
        $fotoproduk = FotoProduk::all();
        $user = User::all();
        $series = Series::orderBy('series', 'asc')->get();

        // Mulai query produk dengan id_toko
        $query = Produk::where('status_produk', 'Aktif')->where('id_toko', $id);

        // Filter berdasarkan search term
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('nama_produk', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('brand', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhereHas('seriesDetail', function ($q) use ($searchTerm) {
                        $q->where('series', 'LIKE', '%' . $searchTerm . '%');
                    });
            });
        }

        // Filter berdasarkan gender
        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        // Filter berdasarkan size
        if ($request->filled('size')) {
            $query->where('ukuran_produk', $request->size);
        }

        // Filter berdasarkan series
        if ($request->filled('series')) {
            $query->whereHas('seriesDetail', function ($q) use ($request) {
                $q->where('id', $request->series);
            });
        }

        // Filter berdasarkan brand
        if ($request->filled('brand')) {
            $query->where('brand', $request->brand);
        }

        $produk = $query->get();

        return view('viewToko', compact('produk', 'fotoproduk', 'toko', 'user', 'series', 'brand'));
    }

    public function viewRules()
    {
        return view('rules');
    }

    public function viewAbout()
    {
        return view('aboutus');
    }

    public function viewPencarian(Request $request)
    {
        // Ambil semua nilai unik brand, tanpa memandang status produk
        $brand = Produk::select('brand')->distinct()->orderBy('brand', 'asc')->pluck('brand');

        // Ambil produk dengan status 'aktif'
        $produkQuery = Produk::where('status_produk', 'aktif');

        // Terapkan filter jika ada
        if ($request->has('brand')) {
            $produkQuery->where('brand', $request->brand);
        }
        $produk = $produkQuery->get();

        // Ambil semua foto produk, toko, dan pengguna
        $fotoproduk = FotoProduk::all();
        $toko = Toko::all();
        $user = User::all();

        // Ambil semua series dan urutkan secara abjad
        $series = Series::orderBy('series', 'asc')->get();
        /* dd(session('profilpath')); */
        return view('pencarian', compact('produk', 'fotoproduk', 'toko', 'user', 'series', 'brand'));
    }

    // SEARCH & FILTER
    public function searchProduk(Request $request)
    {
        $query = Produk::where('status_produk', 'Aktif');
        $fotoproduk = FotoProduk::all();
        $toko = Toko::all();
        $user = User::all();
        $series = Series::orderBy('series', 'asc')->get();
        $brand = Produk::select('brand')->distinct()->orderBy('brand', 'asc')->pluck('brand');

        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where('nama_produk', 'LIKE', '%' . $request->search . '%')
                ->orWhere('brand', 'LIKE', '%' . $request->search . '%')
                ->orWhereHas('seriesDetail', function ($q) use ($searchTerm) {
                    $q->where('series', 'LIKE', '%' . $searchTerm . '%');
                });
        }

        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('size')) {
            $query->where('ukuran_produk', $request->size);
        }

        if ($request->filled('series')) {
            $query->whereHas('series', function ($q) use ($request) {
                $q->where('id_series', $request->series);
            });
        }

        if ($request->filled('brand')) {
            $query->where('brand', $request->brand);
        }

        $produk = $query->get();

        return view('pencarian', compact('produk', 'fotoproduk', 'toko', 'user', 'series', 'brand'));
    }

    public function searchToko(Request $request)
    {
        $search = $request->get('search'); // Mengambil nilai dari input 'search' di form
        $toko = Toko::where('nama_toko', 'like', '%' . $search . '%')->withCount('produks')->get();
        ; // Melakukan pencarian berdasarkan nama toko

        return view('listToko', compact('toko'));
    }

}