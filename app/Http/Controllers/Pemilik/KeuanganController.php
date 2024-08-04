<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use App\Models\OrderPenyewaan;
use App\Models\PengajuanDenda;
use App\Models\Toko;
use App\Models\PenarikanSaldo;
use App\Models\Produk;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class KeuanganController extends Controller
{
    public function dashboardKeuangan()
    {
        $toko = Toko::where('id_user', Auth::id())->first();
        $produkId = $toko->produks->pluck('id');
        $order = OrderPenyewaan::whereIn('id_produk', $produkId)->get();
        foreach ($order as $ord) {
            if ($ord->additional) {
                foreach ($ord->additional as $add) {
                    $ord->totalAdditional += (int) $add['harga'];
                }
            } else {
                $ord->totalAdditional = 0;
            }
            $dendaLainnya = PengajuanDenda::where('nomor_order', $ord->nomor_order)->where('status', 'lunas')->sum('nominal_denda') ?? 0;
            $ord->totalHargaPenyewaan = $ord->total_harga;
            $ord->dendaBelumLunas = $ord->jaminan < 0 ? $ord->jaminan : 0;
            $ord->hargaPenyewaanDanDenda = $ord->totalHargaPenyewaan + ($ord->denda_keterlambatan ?? 0) + $dendaLainnya - abs($ord->dendaBelumLunas);
            $ord->dendaPenyewa = $dendaLainnya;
        }
        $penghasilanBulan = auth()->user()->toko->penghasilan_bulan_ini();
        return view('pemilikSewa.iterasi3.keuangan.dashboardKeuangan', compact('order', 'toko', 'penghasilanBulan'));
    }

    public function viewRiwayatPenarikan()
    {
        $data_penarikan = PenarikanSaldo::where('id_user', auth()->user()->id)->get();
        $penghasilanBulan = auth()->user()->toko->penghasilan_bulan_ini();
        return view('pemilikSewa.iterasi3.keuangan.viewRiwayatPenarikan', compact('data_penarikan', 'penghasilanBulan'));
    }

    public function getPenghasilanBulan($periode)
    {
        $produk = Produk::where('id_toko', auth()->user()->toko->id)->get()->pluck('id')->toArray();
        $penghasilanBulan = OrderPenyewaan::whereIn('id_produk', $produk)->where('status', 'Penyewaan Selesai')->whereMonth('created_at', $periode + 1)->sum('total_penghasilan') ?? 0;
        return view('pemilikSewa.iterasi3.keuangan.penghasilan', compact('penghasilanBulan'))->render();
    }
}