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
use App\Models\Produk;
use App\Models\FotoProduk;

class ProdukSellerController extends Controller
{
    public function viewTambahProduk()
    {
        return view('produk.tambahproduk');
    }

    public function tambahProdukAction(Request $request)
    {
        $user = Auth::user();
        $toko = Toko::where('ID_user', $user->id)->first();

        $validator = Validator::make( $request->all (), [
            'namaProduk' => 'required|string',
            'deskripsiProduk' => 'required|string',
            'kategori' => 'required|in:Fullset,Bawahan saja, Aksesoris, Properti',
            'ukuran' => 'required',
            'foto_produk' => 'required|max:5120',
            'beratProduk' => 'required|numeric',
            'metode_kirim' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $ukuranData = [];
        $ukuranSize = ['S', 'M', 'L', 'XL'];

        // Loop untuk setiap ukuran
        foreach ($ukuranSize as $size) {
            // Memeriksa apakah input untuk harga dan stok dari ukuran tersebut ada dalam request
            if ($request->has("harga_$size") && $request->has("stok_$size")) {
                // Jika ada, tambahkan data untuk ukuran tersebut ke dalam array $ukuranData
                $ukuranData[$size] = [
                'harga' => $request->input("harga_$size"),
                'stok' => $request->input("stok_$size"),
                ];
            }
        }
        
        $produk = new Produk;
        $produk->nama_produk = $request->namaProduk;
        $produk->deskripsi_produk = $request->deskripsiProduk;
        $produk->kategori = $request->kategori;
        $produk->berat_produk = $request->beratProduk;
        $produk->metode_kirim = json_encode($request->metode_kirim);
        $produk->ukuran_produk = $ukuranData;
        $produk->ID_toko = $toko->id;
        $produk->save();
        $id_produk = $produk->getKey();

        foreach ($request->foto_produk as $foto) {
            $path = $foto->store('public/produk/foto_produk');

            // Buat instance model FotoProduk
            $fotoProduk = new FotoProduk();
            $fotoProduk->ID_produk = $id_produk;
            $fotoProduk->path = $path;
            $fotoProduk->save();
        }

        return redirect()->route('seller.viewTambahProduk')->with('success', 'Produk Berhasil Ditambahkan');
    }
}
