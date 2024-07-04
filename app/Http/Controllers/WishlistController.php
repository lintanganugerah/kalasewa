<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Toko;
use App\Models\FotoProduk;
use App\Models\Series;

class WishlistController extends Controller
{
    public function addToWishlist($id)
    {
        $user = Auth::user();
        $wishlist = wishlist::firstOrCreate([
            'user_id' => $user->id,
            'produk_id' => $id,
        ]);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke wishlist');
    }

    public function removeFromWishlist($id)
    {
        $user = Auth::user();
        Wishlist::where('user_id', $user->id)->where('produk_id', $id)->delete();

        return redirect()->back()->with('success', 'Produk berhasil dihapus dari wishlist');
    }

    public function viewWishlist()
    {
        $user = Auth::user();
        $wishlist = $user->wishlist()->with('produk')->get();
        $produk = Produk::all();
        $fotoproduk = FotoProduk::all();
        $toko = Toko::all();
        $user = User::all();
        $series = Series::all();
        $brand = Produk::select('brand')->distinct()->get();

        return view('penyewa.wishlist', compact('wishlist', 'produk', 'fotoproduk', 'toko', 'user', 'series', 'brand'));
    }
}