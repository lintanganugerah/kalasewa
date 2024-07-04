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
        $fotoProduk = FotoProduk::whereIn('id_produk', $produkIds)->get();
        session(['id_produk' => $produk->id]);
        $series = Series::all();
        $decodeAdd = is_array($produk->additional) ? "aaa" : json_decode($produk->additional, true); //Menggubah menjadi array key value "nama" => "harga"

        // dd($decodeAdd, $produk->additional);

        if ($toko->id == $produk->id_toko) {
            return view('produk.editproduk', compact('produk', 'fotoProduk', 'series', 'decodeAdd'));
        } else {
            return redirect()->back()->with('error', 'Produk Invalid');
        }
    }

    public function editProdukAction(Request $request, $id)
    {
        $user = Auth::user();
        $produk = Produk::where('id', $id)->first();
        $toko = Toko::where('id_user', $user->id)->first();

        $validator = Validator::make($request->all(), [
            'namaProduk' => 'required|string',
            'deskripsiProduk' => 'required|string',
            'series' => 'required',
            'ukuran' => 'required',
            'harga' => 'required|numeric|min:100',
            'brand' => 'required|string',
            'gender' => 'required|in:Pria,Wanita',
            'foto_produk' => 'nullable|max:5120',
            'beratProduk' => 'required|numeric|min:10',
            'metode_kirim' => 'required',
        ]);


        if ($toko->id != $produk->id_toko) {
            return redirect()->back()->with('error', "Produk Invalid");
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->has("additional")) {
            $additionalData = [];

            if (count($request->additional) % 2 == 0) { //Cek modulus/modolu kalau sisa total data itu 0 jika dibagi 2 artinya jumlah genap
                // Mengambil index genap sebagai harga, dan ganjil menjadi nama, loncat 2 karena nama dan harga punya index sendiri
                for ($i = 0; $i < count($request->additional); $i += 2) {
                    $nama = $request->additional[$i]; //Simpan isi value index ganjil array $request->additional sebagai nama (key nya) 
                    $harga = $request->additional[$i + 1]; //Simpan isi value index genap array $request->additionalsebagai harga (value nya)


                    // Cek apakah isi string harga itu numeric
                    if (is_numeric($harga)) {
                        if ($additionalData != null) {
                            foreach ($additionalData as $namaTerdaftar => $hargaTerdaftar) {
                                if ($namaTerdaftar == $nama) {
                                    return redirect()->back()->withErrors("Nama Additional Tidak Boleh Saling sama, ganti dengan nama yang lain");
                                }
                            }
                        }
                        $additionalData[$nama] = (int) $harga; // Ubah harga jadi integer, dan memasukkan harga menjadi value dari key $nama. Key nya adalah dari index ganjil nama
                    } else {
                        return redirect()->back()->withErrors("Tipe data Harga pada form additional tidak valid. Mohon Refresh Halaman"); // Menampilkan error jika harga tidak valid
                    }
                }
            } else {
                return redirect()->back()->withErrors("Ada kesalahan data pada Barang Additional, Mohon Refresh halaman");
            }

            $produk->additional = json_encode($additionalData);
        } else {
            $produk->additional = null;
        }

        $produk->nama_produk = $request->namaProduk;
        $produk->deskripsi_produk = $request->deskripsiProduk;
        $produk->id_series = $request->series;
        $produk->brand = $request->brand;
        $produk->harga = $request->harga;
        $produk->gender = $request->gender;
        $produk->berat_produk = $request->beratProduk;
        $produk->metode_kirim = json_encode($request->metode_kirim);
        $produk->ukuran_produk = $request->ukuran;
        $produk->save();

        if ($request->has("foto_produk")) {
            //CEK EKSTENSI FOTO TERLEBIH DAHULU
            foreach ($request->foto_produk as $file) {
                // Ambil ekstensi file
                $extension = $file->getClientOriginalExtension();

                // Periksa ekstensi file sesuai
                if (!in_array($extension, ['jpg', 'jpeg', 'png', 'webp'])) {
                    return redirect()->back()->with('error', 'Foto harus berupa file dengan format jpg, jpeg, png, atau webp.');
                }
            }
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

        return redirect()->back()->with('success', 'Perubahan Produk Berhasil Disimpan');
    }

    public function tambahProdukAction(Request $request)
    {
        $user = Auth::user();
        $toko = Toko::where('id_user', $user->id)->first();

        // dd($request->foto_produk);
        $validator = Validator::make($request->all(), [
            'namaProduk' => 'required|string',
            'deskripsiProduk' => 'required|string',
            'series' => 'required|string', // Mengubah validasi menjadi string
            'ukuran' => 'required|in:XS,S,M,L,XL,XXL,All_Size',
            'harga' => 'required|numeric|min:100',
            'brand' => 'required|string',
            'gender' => 'required|string|in:Pria,Wanita',
            'foto_produk' => 'required|max:5120',
            'beratProduk' => 'required|numeric|min:50',
            'metode_kirim' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        foreach ($request->foto_produk as $file) {
            // Ambil ekstensi file
            $extension = $file->getClientOriginalExtension();

            // Periksa ekstensi file sesuai
            if (!in_array($extension, ['jpg', 'jpeg', 'png', 'webp'])) {
                return redirect()->back()->with('error', 'Foto harus berupa file dengan format jpg, jpeg, png, atau webp.');
            }
        }

        // Cek dan buat series baru jika perlu
        $series = Series::firstOrCreate(['series' => $request->series]);

        $produk = new Produk;
        $produk->nama_produk = $request->namaProduk;
        $produk->deskripsi_produk = $request->deskripsiProduk;
        $produk->id_series = $series->id; // Menggunakan ID series yang ditemukan atau baru dibuat
        $produk->brand = $request->brand;
        $produk->harga = $request->harga;
        $produk->gender = $request->gender;
        $produk->berat_produk = $request->beratProduk;
        $produk->metode_kirim = json_encode($request->metode_kirim);
        $produk->ukuran_produk = $request->ukuran;
        $produk->id_toko = $toko->id;

        if ($request->has("additional")) {
            $additionalData = [];

            if (count($request->additional) % 2 == 0) { //Cek modulus/modolu kalau sisa total data itu 0 jika dibagi 2 artinya jumlah genap
                // Mengambil index genap sebagai harga, dan ganjil menjadi nama, loncat 2 karena nama dan harga punya index sendiri
                for ($i = 0; $i < count($request->additional); $i += 2) {
                    $nama = $request->additional[$i]; //Simpan isi value index ganjil array $request->additional sebagai nama (key nya) 
                    $harga = $request->additional[$i + 1]; //Simpan isi value index genap array $request->additionalsebagai harga (value nya)

                    // Cek apakah isi string harga itu numeric
                    if (is_numeric($harga)) {
                        if ($additionalData != null) {
                            foreach ($additionalData as $namaTerdaftar => $hargaTerdaftar) {
                                if ($namaTerdaftar == $nama) {
                                    return redirect()->back()->withErrors("Nama Additional Tidak Boleh Saling sama, ganti dengan nama yang lain");
                                }
                            }
                        }
                        $additionalData[$nama] = (int) $harga; // Ubah harga jadi integer, dan memasukkan harga menjadi value dari key $nama. Key nya adalah dari index ganjil nama
                    } else {
                        return redirect()->back()->withErrors("Tipe data Harga pada form additional tidak valid. Mohon Refresh Halaman"); // Menampilkan error jika harga tidak valid
                    }
                }
            } else {
                return redirect()->back()->withErrors("Ada kesalahan data pada Barang Additional, Mohon Refresh halaman");
            }
            $produk->additional = json_encode($additionalData);
        }

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
            // Cek jumlah foto yang tersisa
            $jumlahFoto = FotoProduk::where('id_produk', $produk->id)->count();

            if ($jumlahFoto == 1) {
                return redirect()->back()->with('error', 'Tidak dapat menghapus foto terakhir. Harap tambahkan foto pengganti nya lalu klik simpan perubahan');
            }

            // Hapus foto dari storage
            $path = $foto->path;
            Storage::delete(str_replace('storage/', 'public/', $path));

            // Hapus foto dari database
            $foto->delete();

            return redirect()->back()->with('success', 'Foto berhasil dihapus');
        } else {
            return redirect()->back()->with('error', 'Terjadi kesalahan, silahkan refresh browser anda');
        }
    }
}