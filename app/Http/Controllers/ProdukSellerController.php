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
use App\Models\Series;
use App\Models\Produk;
use App\Models\FotoProduk;

class ProdukSellerController extends Controller
{
    public function viewTambahProduk()
    {
        $series = Series::all();
        return view('produk.tambahproduk', compact('series'));
    }

    public function viewProdukAnda()
    {
        $user = Auth::user();
        $toko = Toko::where('id_user', $user->id)->first();
        $produk = Produk::where('id_toko', $toko->id)->get();
        $produkIds = $produk->pluck('id');
        $seriesIds = $produk->pluck('id_series');
        $fotoProduk = FotoProduk::whereIn('id_produk', $produkIds)->get();
        $series = Series::whereIn('id', $seriesIds)->get();

        return view('produk.produkanda', compact('produk', 'fotoProduk', 'series'));
    }

    public function viewEditProduk($id)
    {
        $user = Auth::user();
        $toko = Toko::where('id_user', $user->id)->first();
        $produk = Produk::find($id);
        if (!$produk) {
            return redirect()->route('seller.viewProdukAnda')->with('error', 'Produk Invalid');
        }
        $produkIds = $produk->pluck('id');
        $decodeKirim = json_decode($produk->metode_kirim);
        $fotoProduk = FotoProduk::whereIn('id_produk', $produkIds)->get();
        $ukuranKey = array_keys($produk->ukuran_produk);
        session(['id_produk' => $produk->id]);
        $series = Series::all();

        if ($toko->id == $produk->id_toko) {
            return view('produk.editproduk', compact('produk', 'fotoProduk', 'decodeKirim', 'ukuranKey', 'series'));
        } else {
            return redirect()->back()->with('error', 'Produk Invalid');
        }
    }

    public function editProdukAction(Request $request, $id)
    {
        $user = Auth::user();
        $produk = Produk::where('id', $id)->first();
        $toko = Toko::where('id_user', $user->id)->first();

        $validator = Validator::make( $request->all (), [
            'namaProduk' => 'required|string',
            'deskripsiProduk' => 'required|string',
            'series' => 'required',
            'ukuran' => 'required',
            'harga' => 'required|numeric',
            'brand' => 'required|string',
            'gender' => 'required|in:Pria, Wanita',
            'foto_produk' => 'nullable|max:5120',
            'beratProduk' => 'required|numeric',
            'metode_kirim' => 'required',
        ]);

        if ($toko->id != $produk->id_toko) {
            return redirect()->back()->with('error', "Produk Invalid");
        }

        if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
        }

        $ukuranData = [];
        $ukuranSize = ['S', 'M', 'L', 'XL'];

        // Loop untuk setiap ukuran
        foreach ($ukuranSize as $size) {
            // Memeriksa apakah input untuk harga dan stok dari ukuran tersebut ada dalam request
            if ($request->has("stok_$size")) {
                // Jika ada, tambahkan data untuk ukuran tersebut ke dalam array $ukuranData
                $ukuranData[$size] = [
                    'stok' => $request->input("stok_$size"),
                ];
            }
        }

        $produk->nama_produk = $request->namaProduk;
        $produk->deskripsi_produk = $request->deskripsiProduk;
        $produk->id_series = $request->series;
        $produk->brand = $request->brand;
        $produk->harga = $request->harga;
        $produk->gender = $request->gender;
        $produk->berat_produk = $request->beratProduk;
        $produk->metode_kirim = json_encode($request->metode_kirim);
        $produk->ukuran_produk = $ukuranData;
        $produk->save();

        if($request->has("foto_produk")) {
            foreach ($request->foto_produk as $foto) {
                $pathSebelum = $foto->store('public/produk/foto_produk');
                $path = str_replace('public/', 'storage/', $pathSebelum);

                // Buat instance model FotoProduk
                $fotoProduk = new FotoProduk();
                $fotoProduk->id_produk = $id;
                $fotoProduk->path = $path;
                $fotoProduk->save();
            }
        }

        return redirect()->route('seller.viewProdukAnda')->with('success', 'Produk Berhasil Diubah');
    }

    public function tambahProdukAction(Request $request)
    {
        $user = Auth::user();
        $toko = Toko::where('id_user', $user->id)->first();

        $validator = Validator::make( $request->all (), [
            'namaProduk' => 'required|string',
            'deskripsiProduk' => 'required|string',
            'series' => 'required|exists:series,id',
            'ukuran' => 'required',
            'harga' => 'required|numeric',
            'brand' => 'required|string',
            'gender' => 'required|string|in:Pria,Wanita',
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
            if ($request->has("stok_$size")) {
                // Jika ada, tambahkan data untuk ukuran tersebut ke dalam array $ukuranData
                $ukuranData[$size] = [
                    'stok' => $request->input("stok_$size"),
                ];
            }
        }
        
        $produk = new Produk;
        $produk->nama_produk = $request->namaProduk;
        $produk->deskripsi_produk = $request->deskripsiProduk;
        $produk->id_series = $request->series;
        $produk->brand = $request->brand;
        $produk->harga = $request->harga;
        $produk->gender = $request->gender;
        $produk->berat_produk = $request->beratProduk;
        $produk->metode_kirim = json_encode($request->metode_kirim);
        $produk->ukuran_produk = $ukuranData;
        $produk->id_toko = $toko->id;
        $produk->save();
        $id_produk = $produk->getKey();

        foreach ($request->foto_produk as $foto) {
            $pathSebelum = $foto->store('public/produk/foto_produk');
            $path = str_replace('public/', 'storage/', $pathSebelum);

            // Buat instance model FotoProduk
            $fotoProduk = new FotoProduk();
            $fotoProduk->id_produk = $id_produk;
            $fotoProduk->path = $path;
            $fotoProduk->save();
        }

        return redirect()->route('seller.viewProdukAnda')->with('success', 'Produk Berhasil Ditambahkan');
    }

    public function arsipProduk($id)
    {
        $user = Auth::user();
        $toko = Toko::where('id_user', $user->id)->first();
        $produk = Produk::find($id);
        if (!$produk) {
            return redirect()->back()->with('error', 'Produk Invalid');
        }
        if ($toko->id == $produk->id_toko) {
            $produk->update(['status_produk' => 'arsip']);
            return redirect()->back()->with('success', 'Produk berhasil diarsipkan.');
        } else {
             return redirect()->back()->with('error', 'Produk Invalid');
        }
    }

    public function aktifkanProduk($id)
    {
        $user = Auth::user();
        $toko = Toko::where('id_user', $user->id)->first();
        $produk = Produk::find($id);
        if (!$produk) {
            return redirect()->back()->with('error', 'Produk Invalid');
        }
        if ($toko->id == $produk->id_toko) {
            $produk->update(['status_produk' => 'aktif']);
            return redirect()->back()->with('success', 'Produk berhasil diaktifkan untuk ditampilkan pada marketplace.');
        } else {
            return redirect()->back()->with('error', 'Produk Invalid');
        }
    }

    public function hapusProduk($id)
    {
        $user = Auth::user();
        $toko = Toko::where('id_user', $user->id)->first();
        $produk = Produk::find($id);
        if (!$produk) {
            return redirect()->back()->with('error', 'Produk Invalid');
        }
        if ($toko->id == $produk->id_toko) {
            $fotoProduk = FotoProduk::where('id_produk', $produk->id)->get();
            if ($fotoProduk) {
                foreach ($fotoProduk as $foto) {
                    $path = $foto->path; // Path foto di storage
                    Storage::delete(str_replace('storage/', 'public/', $path));
                    $foto->delete(); // Hapus entri foto dari database
                }
            }
            $produk->delete();
            return redirect()->back()->with('success', 'Produk berhasil dihapus');
        } else {
            return redirect()->back()->with('error', 'Produk Invalid');
        }
    }

    public function hapusFoto($id)
    {
        $user = Auth::user();
        $toko = Toko::where('id_user', $user->id)->first();
        $foto = FotoProduk::find($id);
        if (!$foto) {
            return redirect()->back()->with('error', 'Foto Invalid');
        }
        $produk = Produk::where('id', session('id_produk'))->first();
        if ($foto->id_produk == $produk->id) {
            $path = $foto->path;
            Storage::delete(str_replace('storage/', 'public/', $path));
            $foto->delete();
            return redirect()->back()->with('success', 'Foto berhasil dihapus');
        } else {
            return redirect()->back()->with('error', 'Terjadi kesalahan, silahkan refresh browser anda');
        }
    }
}
