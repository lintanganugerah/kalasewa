<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdukSellerController extends Controller
{
    public function viewTambahProduk()
    {
        return view('produk.tambahproduk');
    }
}
