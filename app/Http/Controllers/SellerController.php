<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Toko;

class SellerController extends Controller
{
    public function sellerBerandaView(Request $request) {
        $user = Auth::user();
        if (!isset($user->nama)) {
            return redirect()->route('seller.registerInformationView');
        }
        return view('beranda');
    }
    public function profilTokoView(Request $request) {
         $user = Auth::user();
        return view('profiltoko', compact('user'));
    }
}
