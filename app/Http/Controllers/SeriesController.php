<?php

namespace App\Http\Controllers;

use App\Models\Series;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    // Metode untuk melakukan pencarian
    public function search(Request $request)
    {
        if ($request->has('search')) {
            $series = Series::where('series', 'LIKE', "%" . $request->search . '%')->get();
        } else {
            $series = Series::all();
        }

        return view('admin.series.index', ['series' => $series]);
    }
    public function index()
    {
        $series = Series::paginate(10);
        return view('admin.series.index', compact('series'));
    }

    public function create()
    {
        return view('admin.series.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'series' => 'required|string|max:255',
        ]);

        Series::create([
            'series' => $request->series,
        ]);

        return redirect()->route('admin.series.index')->with('success', 'Series berhasil ditambahkan.');
    }

    public function show($id)
    {
        $series = Series::findOrFail($id);
        return view('admin.series.show', compact('series'));
    }

    public function edit($id)
    {
        $series = Series::findOrFail($id);
        return view('admin.series.edit', compact('series'));
    }

    public function update(Request $request, Series $series)
    {
        $request->validate([
            'series' => 'required|string|max:255',
        ]);

        $series->update([
            'series' => $request->series,
        ]);

        return redirect()->route('admin.series.index')->with('success', 'Series berhasil diperbarui.');
    }

    public function destroy(Series $series)
    {
        $series->delete();

        return redirect()->route('admin.series.index')
            ->with('success', 'Series berhasil dihapus.');
    }
}