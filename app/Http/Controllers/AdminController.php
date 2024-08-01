<?php

namespace App\Http\Controllers;

use App\Models\Series;
use Illuminate\Http\Request;
use App\Models\Peraturan;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard', );
    }

    public function series()
    {
        $series = Series::all(); // Ambil semua data series dari tabel 'series'

        return view('admin.series', compact('series'));
    }

    public function indexRegulations()
    {
        $peraturansUmum = Peraturan::where('Audience', 'umum')->get();
        $peraturansPenyewa = Peraturan::where('Audience', 'penyewa')->get();
        $peraturansPemilikSewa = Peraturan::where('Audience', 'pemilik sewa')->get();

        return view('admin.regulations.index', compact('peraturansUmum', 'peraturansPenyewa', 'peraturansPemilikSewa'));
    }


    public function editRegulations($id)
    {
        $peraturan = Peraturan::find($id);
        return view('admin.regulations.edit', compact('peraturan'));
    }


    public function updateRegulations(Request $request)
    {
        $request->validate([
            'Peraturan.*' => 'required|string',
        ]);

        foreach ($request->Peraturan as $id => $isi) {
            $peraturan = Peraturan::find($id);
            $peraturan->update([
                'Peraturan' => $isi,
            ]);
        }

        return redirect()->route('admin.regulations.index')->with('success', 'Peraturan berhasil diperbarui');
    }
}