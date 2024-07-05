<?php

namespace App\Http\Controllers;

use App\Models\AlamatTambahan;
use App\Models\PeraturanSewa;
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
use Exception;

class SellerController extends Controller
{
    public function jadiSellerView(Request $request)
    {
        return view('jadiseller');
    }

    public function sellerDashboardToko(Request $request)
    {
        return view('pemilikSewa.dashboardToko');
    }

    public function testView()
    {
        return view('tes');
    }

    public function profilTokoView(Request $request)
    {
        $user = Auth::user();
        $toko = Toko::where('id_user', $user->id)->first();
        $decodeKirim = json_decode($toko->metode_kirim);
        $alamatTambahan = AlamatTambahan::where('id_toko', $toko->id)->get();
        return view('profiltoko', compact('user', 'toko', 'decodeKirim', 'alamatTambahan'));
    }

    // PERATURAN SEWA

    public function viewPeraturanSewaToko(Request $request)
    {
        $toko = Toko::where('id_user', Auth::id())->first();
        $peraturan = PeraturanSewa::where('id_toko', $toko->id)->get();
        return view('pemilikSewa.iterasi2.peraturanSewa.peraturanSewaToko', compact('peraturan'));
    }

    public function viewEditPeraturanSewa(Request $request, $id)
    {
        $toko = Toko::where('id_user', Auth::id())->first();
        $peraturan = PeraturanSewa::where('id', $id)->first();
        if ($peraturan) {
            if ($toko->id != $peraturan->id_toko) {
                return redirect()->back()->with('error', 'ID Peraturan Invalid');
            }
            return view('pemilikSewa.iterasi2.peraturanSewa.editPeraturanSewaToko', compact('peraturan'));
        } else {
            return redirect()->route('seller.profil.viewPeraturanSewaToko')->with('error', 'ID Peraturan Invalid');
        }
    }

    public function viewTambahPeraturanSewa(Request $request)
    {
        return view('pemilikSewa.iterasi2.peraturanSewa.tambahPeraturanSewaToko');
    }

    public function EditPeraturanSewaAction(Request $request, $id)
    {
        $toko = Toko::where('id_user', Auth::id())->first();
        $peraturan = PeraturanSewa::where('id', $id)->first();
        if ($peraturan) {
            if ($toko->id != $peraturan->id_toko) {
                return redirect()->back()->with('error', 'ID Peraturan Invalid');
            }
        } else {
            return redirect()->route('seller.profil.viewPeraturanSewaToko')->with('error', 'ID Peraturan Invalid');
        }

        if ($peraturan->nama == "Terlambat Mengembalikan Kostum") {
            $validator = Validator::make($request->all(), [
                'deskripsiPeraturan' => 'required|string',
                'nominal_denda' => 'required|numeric'
            ]);
            $peraturan->denda_pasti = $request->nominal_denda;
        } elseif ($request->denda == 'ya') {
            $validator = Validator::make($request->all(), [
                'namaPeraturan' => 'required|string',
                'deskripsiPeraturan' => 'required|string',
                'denda' => 'required',
                'DendaPasti' => 'required',
                'nominal_denda' => 'required|numeric'
            ]);
            if ($request->DendaPasti == 'ya') {
                // DENDA NOMINAL
                $validator = Validator::make($request->all(), [
                    'nominal_denda' => 'required|numeric'
                ]);

                $peraturan->denda_pasti = $request->nominal_denda;
            } else {
                // DENDA KONDISIONAL
                $validator = Validator::make($request->all(), [
                    'nominal_denda' => 'required|string'
                ]);
                $peraturan->denda_kondisional = $request->nominal_denda;
            }
            $peraturan->nama = $request->namaPeraturan;
            $peraturan->terdapat_denda = true;
        } else {
            $validator = Validator::make($request->all(), [
                'namaPeraturan' => 'required|string',
                'deskripsiPeraturan' => 'required|string',
                'denda' => 'required',
            ]);
            $peraturan->nama = $request->namaPeraturan;
            $peraturan->terdapat_denda = false;
            $peraturan->denda_pasti = null;
            $peraturan->denda_kondisional = null;
        }
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $peraturan->deskripsi = $request->deskripsiPeraturan;

        $peraturan->save();
        return redirect()->route('seller.profil.viewPeraturanSewaToko')->with("success", "Perubahan Berhasil Disimpan!");
    }

    public function TambahPeraturanSewaAction(Request $request)
    {
        $toko = Toko::where('id_user', Auth::id())->first();

        $validator = Validator::make($request->all(), [
            'namaPeraturan' => 'required|string',
            'deskripsiPeraturan' => 'required|string',
            'denda' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->denda == "ya") {
            $terdapat_denda = true;
            if ($request->DendaPasti == "tidak") {
                $validator = Validator::make($request->all(), [
                    'nominal_denda' => 'required|string'
                ]);
            } else {
                $validator = Validator::make($request->all(), [
                    'nominal_denda' => 'required|numeric'
                ]);
            }
        } else {
            $terdapat_denda = false;
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $denda_pasti = null;
        $denda_kondisional = null;

        if ($request->DendaPasti == "ya") {
            $denda_pasti = $request->nominal_denda;
        } else {
            $denda_kondisional = $request->nominal_denda;
        }

        $peraturan = PeraturanSewa::create([
            'nama' => $request->namaPeraturan,
            'deskripsi' => $request->deskripsiPeraturan,
            'id_toko' => $toko->id,
            'terdapat_denda' => $terdapat_denda,
            'denda_pasti' => $denda_pasti,
            'denda_kondisional' => $denda_kondisional,
        ]);
        return redirect()->route('seller.profil.viewPeraturanSewaToko')->with("success", "Peraturan Berhasil Ditambahkan!");
    }

    public function DeletePeraturanSewaAction($id)
    {
        $toko = Toko::where('id_user', Auth::id())->first();
        $peraturan = PeraturanSewa::where('id', $id)->first();
        if ($peraturan) {
            if ($toko->id != $peraturan->id_toko) {
                return redirect()->back()->with('error', 'ID Peraturan Invalid');
            }
            if ($peraturan->nama == "Terlambat Mengembalikan Kostum") {
                return redirect()->back()->with('error', 'Anda Tidak Menghapus Peraturan Wajib "Terlambat Mengembalikan Kostum"');
            }
            $peraturan->delete();
            return redirect()->route('seller.profil.viewPeraturanSewaToko')->with("success", "Peraturan Berhasil Dihapus!");
        } else {
            return redirect()->route('seller.profil.viewPeraturanSewaToko')->with('error', 'Peraturan Tidak Ditemukan, gagal menghapus');
        }
    }

    // END PERATURAN SEWA

    public function profilTokoAction(Request $request)
    {
        $user = Auth::user();
        $toko = Toko::where('id_user', $user->id)->first();

        $validator = Validator::make($request->all(), [
            'namaToko' => 'required|string',
            'link_sosial_media' => 'required|url',
            'nomor_telpon' => 'required|numeric|min_digits:10|max_digits:13',
            'AlamatToko' => 'required|string',
            'kota' => 'required|in:Kota Bandung,Kabupaten Bandung',
            'provinsi' => 'required|in:Jawa Barat',
            'kodePos' => 'required|numeric|min_digits:5|max_digits:5',
            'foto' => 'file|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $cekToko = DB::table('tokos')->where('nama_toko', $request->namaToko)->first();
        if ($cekToko && $cekToko->id_user != $user->id) {
            return redirect()->back()->withErrors(['namaToko' => 'Nama Toko telah ada, coba nama toko lain'])->withInput();
        }

        $fotoPath = $user->foto_profil;
        $namaFile = basename($fotoPath);

        if ($request->has('foto')) {
            if ($namaFile !== 'profil_default.jpg') {
                Storage::delete(str_replace('storage/', 'public/', $fotoPath));
            }
            $photoPath = $request->file('foto')->store('public/profiles');
            $photoPath = Str::replaceFirst('public/', 'storage/', $photoPath);
            $user->foto_profil = $photoPath;
            $user->save();
        }

        if ($request->has('bio_toko')) {
            $toko->bio_toko = $request->bio_toko;
        }

        $user->no_telp = $request->nomor_telpon;
        $user->alamat = $request->AlamatToko;
        $user->kota = $request->kota;
        $user->kode_pos = $request->kodePos;
        $user->link_sosial_media = $request->link_sosial_media;
        $toko->nama_toko = $request->namaToko;
        $user->save();
        $toko->save();

        session(['uid' => $user->id]);
        session(['namatoko' => $toko->nama_toko]);
        session(['profilpath' => $user->foto_profil]);

        return redirect()->route('seller.profilTokoView')->with('success', 'Profil Berhasil Di ubah');
    }

    // ALAMAT TAMBAHAN TOKO

    public function viewAlamatTambahanToko(Request $request)
    {
        $toko = Toko::where('id_user', Auth::id())->first();
        $alamatTambahan = AlamatTambahan::where('id_toko', $toko->id)->orderByDesc('updated_at')->get();
        return view('pemilikSewa.alamat_tambahan.view_alamatTambahanToko', compact('alamatTambahan'));
    }

    public function viewTambahAlamatTambahan()
    {
        return view('pemilikSewa.alamat_tambahan.tambah_alamatTambahanToko');
    }

    public function TambahAlamatTambahanAction(Request $request)
    {
        $toko = Toko::where('id_user', Auth::id())->first();

        $validator = Validator::make($request->all(), [
            'alamatNameTambahan' => 'required|string',
            'alamatTambahan' => 'required|string',
            'kodePosTambahan' => 'required|numeric|min_digits:5|max_digits:5',
            'provinsiTambahan' => 'required|string|in:Jawa Barat',
            'kotaTambahan' => 'required|string|in:Kota Bandung,Kabupaten Bandung',
        ]);

        $idAlamatTambahan = time() . $toko->id . rand(1, 50);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        AlamatTambahan::create([
            'id' => $idAlamatTambahan,
            'id_toko' => $toko->id,
            'nama' => $request->alamatNameTambahan,
            'alamat' => $request->alamatTambahan,
            'kode_pos' => $request->kodePosTambahan,
            'provinsi' => $request->provinsiTambahan,
            'kota' => $request->kotaTambahan,
        ]);

        $toko->update(['isAlamatTambahan' => true]);

        return redirect()->route('seller.profil.viewAlamatTambahanToko')->with('success', 'Alamat Berhasil Ditambahkan');
    }


    public function viewEditAlamatTambahan(Request $request, $id)
    {
        $toko = Toko::where('id_user', Auth::id())->first();
        $at = AlamatTambahan::where('id', $id)->first();

        if ($at) {
            if ($toko->id != $at->id_toko) {
                return redirect()->route('seller.profil.viewAlamatTambahanToko')->with('error', 'ID Alamat Invalid');
            }
        } else {
            return redirect()->route('seller.profil.viewAlamatTambahanToko')->with('error', 'Alamat Tidak Ditemukan/Sudah Dihapus');
        }

        return view('pemilikSewa.alamat_tambahan.edit_alamatTambahanToko', compact('at'));
    }

    public function EditAlamatTambahanAction(Request $request, $id)
    {
        $toko = Toko::where('id_user', Auth::id())->first();
        $at = AlamatTambahan::where('id', $id)->first();

        if ($at) {
            if ($toko->id != $at->id_toko) {
                return redirect()->route('seller.profil.viewAlamatTambahanToko')->with('error', 'ID Alamat Invalid');
            }
        } else {
            return redirect()->route('seller.profil.viewAlamatTambahanToko')->with('error', 'Alamat Tidak Ditemukan/Sudah Dihapus');
        }

        $validator = Validator::make($request->all(), [
            'alamatNameTambahan' => 'required|string',
            'alamatTambahan' => 'required|string',
            'kodePosTambahan' => 'required|numeric|min_digits:5|max_digits:5',
            'provinsiTambahan' => 'required|string|in:Jawa Barat',
            'kotaTambahan' => 'required|string|in:Kota Bandung,Kabupaten Bandung',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $at->update([
            'nama' => $request->alamatNameTambahan,
            'alamat' => $request->alamatTambahan,
            'kode_pos' => $request->kodePosTambahan,
            'provinsi' => $request->provinsiTambahan,
            'kota' => $request->kotaTambahan,
        ]);

        return redirect()->route('seller.profil.viewAlamatTambahanToko')->with('success', 'Alamat Berhasil Ditambahkan');
    }

    public function DeleteAlamatTambahanAction($id)
    {
        $toko = Toko::where('id_user', Auth::id())->first();
        $alamat = AlamatTambahan::where('id', $id)->first();
        if ($alamat) {
            if ($toko->id != $alamat->id_toko) {
                return redirect()->back()->with('error', 'ID alamat Invalid');
            }
            $produk = Produk::where('id_alamat', $alamat->id)->get();
            if ($produk) {
                foreach ($produk as $pd) {
                    $pd->id_alamat = null;
                    $pd->save();
                }
            }
            $alamat->delete();
            $masihAda = AlamatTambahan::where('id_toko', $toko->id)->exists();

            if (!$masihAda) {
                $toko->update(['isAlamatTambahan' => false]);
            }
            return redirect()->route('seller.profil.viewAlamatTambahanToko')->with("success", "Alamat Berhasil Dihapus!");
        } else {
            return redirect()->route('seller.profil.viewAlamatTambahanToko')->with('error', 'Alamat Tidak Ditemukan, gagal menghapus');
        }
    }
}