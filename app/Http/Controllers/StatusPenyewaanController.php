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
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;


class StatusPenyewaanController extends Controller
{

    public function viewBelumDiProses(Request $request)
    {
        return view('pemilikSewa.iterasi2.pesanan.belumdiproses');
    }

}