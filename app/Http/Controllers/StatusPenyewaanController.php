<?php

namespace App\Http\Controllers;

use App\Models\OrderPenyewaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Toko;
use App\Models\Produk;
use Illuminate\Support\Facades\Mail;


class StatusPenyewaanController extends Controller
{

    public function viewBelumDiProses(Request $request)
    {
        $toko = Toko::where('id_user', Auth::id())->first();
        $produk = Produk::where('id_toko', $toko->id)->get()->pluck('id')->toArray();
        $order = OrderPenyewaan::whereIn('id_produk', $produk)->where('status', 'Menunggu di Proses')->get();

        return view('pemilikSewa.iterasi2.pesanan.belumdiproses', compact('order'));
    }

    public function viewDalamPengiriman(Request $request)
    {
        $toko = Toko::where('id_user', Auth::id())->first();
        $produk = Produk::where('id_toko', $toko->id)->get()->pluck('id')->toArray();
        $order = OrderPenyewaan::whereIn('id_produk', $produk)->where('status', 'Dalam Pengiriman')->get();
        return view('pemilikSewa.iterasi2.pesanan.dalamPengiriman', compact('order'));
    }

    public function viewSedangBerlangsung(Request $request)
    {
        $toko = Toko::where('id_user', Auth::id())->first();
        $produk = Produk::where('id_toko', $toko->id)->get()->pluck('id')->toArray();
        $order = OrderPenyewaan::whereIn('id_produk', $produk)->where('status', 'Sedang Berlangsung')->get();
        return view('pemilikSewa.iterasi2.pesanan.sedangBerlangsung', compact('order'));
    }

    public function viewTelahKembali(Request $request)
    {
        $toko = Toko::where('id_user', Auth::id())->first();
        $produk = Produk::where('id_toko', $toko->id)->get()->pluck('id')->toArray();
        $order = OrderPenyewaan::whereIn('id_produk', $produk)->where('status', 'Telah Kembali')->get();
        return view('pemilikSewa.iterasi2.pesanan.telahKembali', compact('order'));
    }

    public function viewPenyewaanDiretur(Request $request)
    {
        $toko = Toko::where('id_user', Auth::id())->first();
        $produk = Produk::where('id_toko', $toko->id)->get()->pluck('id')->toArray();
        $order = OrderPenyewaan::whereIn('id_produk', $produk)->where('status', 'Retur dalam Pengiriman')->get();
        return view('pemilikSewa.iterasi2.pesanan.sewaRetur', compact('order'));
    }

    public function viewRiwayatPenyewaan(Request $request)
    {
        $toko = Toko::where('id_user', Auth::id())->first();
        $produk = Produk::where('id_toko', $toko->id)->get()->pluck('id')->toArray();
        $order = OrderPenyewaan::whereIn('id_produk', $produk)->whereIn('status', ['Penyewaan Selesai', 'Retur Selesai', 'Dibatalkan Penyewa', 'Dibatalkan Pemilik Sewa'])->get();

        return view('pemilikSewa.iterasi2.pesanan.riwayatPenyewaan', compact('order'));
    }

    public function inputResi(Request $request, $nomor_order)
    {
        $order = OrderPenyewaan::where('nomor_order', $nomor_order)->first();
        $toko = Toko::where('id_user', Auth::id())->first();

        $validator = Validator::make($request->all(), [
            'nomor_resi' => 'required|string'
        ]);

        if (!$order) {
            return redirect()->back()->with('error', "Order Tidak ditemukan/Sudah dihapus");
        }

        if ($toko->id != $order->id_produk_order->id_toko) {
            return redirect()->back()->with('error', "Produk Invalid. Silahkan Refresh Halaman Anda");
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $order->nomor_resi = $request->nomor_resi;
        $order->status = "Dalam Pengiriman";
        $order->save();

        return redirect()->route('seller.statuspenyewaan.belumdiproses')->with('success', 'Status Produk berhasil diubah! Silahkan klik tab "Dalam Pengiriman" untuk melihat');
    }

    public function returSelesai($nomor_order)
    {
        $order = OrderPenyewaan::where('nomor_order', $nomor_order)->first();
        $toko = Toko::where('id_user', Auth::id())->first();

        if (!$order) {
            return redirect()->back()->with('error', "Order Tidak ditemukan/Sudah dihapus");
        }

        if ($toko->id != $order->id_produk_order->id_toko) {
            return redirect()->back()->with('error', "Produk Invalid. Silahkan Refresh Halaman Anda");
        }

        $order->status = "Retur Selesai";
        $order->save();

        return redirect()->route('seller.statuspenyewaan.penyewaandiretur')->with('success', 'Status Produk berhasil diubah! Penyewaan yang diretur telah diterima anda!');
    }

    public function dibatalkanPemilikSewa(Request $request, $nomor_order)
    {
        $order = OrderPenyewaan::where('nomor_order', $nomor_order)->first();
        $toko = Toko::where('id_user', Auth::id())->first();

        $validator = Validator::make($request->all(), [
            'alasan_batal' => 'required|string'
        ]);

        if (!$order) {
            return redirect()->back()->with('error', "Order Tidak ditemukan/Sudah dihapus");
        }

        if ($toko->id != $order->id_produk_order->id_toko) {
            return redirect()->back()->with('error', "Order Invalid. Silahkan Refresh Halaman Anda");
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $order->status = "Dibatalkan Pemilik Sewa";
        $order->alasan_pembatalan = $request->alasan_batal;
        $order->save();

        return redirect()->route('seller.statuspenyewaan.belumdiproses')->with('success', 'Penyewaan telah anda Batalkan!');
    }

    public function ingatkanPenyewa($nomor_order, $id_penyewa)
    {
        $order = OrderPenyewaan::where('nomor_order', $nomor_order)->where('status', 'Sedang Berlangsung')->first();
        $penyewa = User::where('role', 'penyewa')->where('id', $id_penyewa)->first();
        $toko = Toko::where('id_user', Auth::id())->first();


        if (!$order) {
            return redirect()->back()->with('error', "Order Tidak ditemukan");
        }

        if ($order->id_penyewa != $penyewa->id) {
            return redirect()->back()->with('error', "Produk Invalid. Silahkan Refresh Halaman Anda");
        }

        if ($toko->id != $order->id_produk_order->id_toko) {
            return redirect()->back()->with('error', "Produk Invalid. Silahkan Refresh Halaman Anda");
        }


        $tanggalSelesaiBatasMax = Carbon::parse($order->tanggal_selesai)->addDays()->format('d-m-Y');
        $tanggalSelesai = Carbon::parse($order->tanggal_selesai)->format('d-m-Y');

        //BIKIN MAIL DISINI
        Mail::to($penyewa->email)->send(new \App\Mail\ingatkanPenyewa($order->nomor_order, $tanggalSelesai, $tanggalSelesaiBatasMax, $penyewa->nama, $toko->nama_toko, $order->id_produk_order->nama_produk));

        return redirect()->route('seller.statuspenyewaan.sedangberlangsung')->with('success', 'Berhasil mengirimkan email pengingat untuk mengembalikan kostum kepada penyewa');
    }

}