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

class PublicController extends Controller
{

    // MARKETPLACE HOMEPAGE
    public function viewHomepage(Request $request)
    {
        $produk = Produk::where('status_produk', 'aktif')->get();
        $fotoproduk = FotoProduk::all();
        $toko = Toko::all();
        $user = User::all();
        $series = Series::all();
        $brand = Produk::select('brand')->distinct()->get();
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

        return view('detail', compact('produk', 'fotoproduk', 'series', 'brand'));
    }

    public function viewRules()
    {
        return view('rules');
    }

    public function viewAbout()
    {
        return view('aboutus');
    }

    // SEARCH & FILTER
    public function search(Request $request)
    {
        $query = $request->input('search');
        $ukuran_produk = $request->input('ukuran_produk');
        $gender = $request->input('gender');
        $series = $request->input('series');
        $brands = $request->input('brand');

        $products = Produk::where('status_produk', 'aktif');

        if ($query) {
            $products = $products->where('nama_produk', 'LIKE', "%{$query}%");
        }

        if ($gender) {
            $products = $products->where('gender', $gender);
        }

        if ($series) {
            $products = $products->where('id_series', $series);
        }

        if ($brands) {
            $products = $products->where('brand', $brands);
        }

        if ($ukuran_produk) {
            $products = $products->where('ukuran_produk', $ukuran_produk);
        }

        $products = $products->get();

        $fotoproduk = FotoProduk::all();
        $toko = Toko::all();
        $user = User::all();
        $series = Series::all();
        $brand = Produk::select('brand')->distinct()->get();

        return view('homepage', [
            'produk' => $products,
            'fotoproduk' => $fotoproduk,
            'toko' => $toko,
            'user' => $user,
            'series' => $series
        ], compact('series', 'brand'));
    }

}