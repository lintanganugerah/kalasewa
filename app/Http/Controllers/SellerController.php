<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function sellerBerandaView(Request $request) {
        return view('beranda');
    }
}
