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

class CatalogController extends Controller
{
    
    public function search(Request $request)
    {
        $query = $request->input('search');
        $ukuran_produk = $request->input('ukuran_produk');
        $gender = $request->input('gender');
        $series = $request->input('series');
        $brands = $request->input('brand');

        $products = Produk::query();

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
        
        $products = $products->get();
        
        if ($ukuran_produk) {
            $sizeGetId = [];
            $produkAll = Produk::all();
            $produk = new Collection();
            $series = Series::all();
            $user = User::all();
            $brand = Produk::select('brand')->distinct()->get();
            $fotoproduk = FotoProduk::all();
            $toko = Toko::all();
            foreach ($produkAll as $prod) {
                foreach ($prod->ukuran_produk as $size => $detail) {
                    if($size == $ukuran_produk) {
                        $produk->push($prod);
                    }
                }
            }
            return view('homepage', compact('produk', 'fotoproduk', 'toko', 'user', 'series', 'brand'));
            // $products = $products->whereJsonContains('ukuran_produk', $ukuran_produk);
        }

        Log::info('Search Query:', [
            'query' => $query,
            'ukuran_produk' => $ukuran_produk,
            'gender' => $gender,
            'series' => $series,
            'brands' => $brands,
            'result_count' => $products->count()
        ]);

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
