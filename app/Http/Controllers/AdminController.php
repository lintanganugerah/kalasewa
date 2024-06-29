<?php

namespace App\Http\Controllers;
use App\Models\Series;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard',);
    }

    public function series()
    {
        $series = Series::all(); // Ambil semua data series dari tabel 'series'

        return view('admin.series', compact('series'));
    }
}
