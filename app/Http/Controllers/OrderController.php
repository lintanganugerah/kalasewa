<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Toko;
use App\Models\Penyewa;
use App\Models\Produk;
use App\Models\FotoProduk;
use App\Models\Series;
use App\Models\OrderPenyewaan;
use App\Models\Checkout;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Collection;

class OrderController extends Controller
{
    public function viewOrder($id)
    {

        $produk = Produk::with('toko.user')->findOrFail($id);
        $fotoproduk = FotoProduk::where('ID_produk', $id)->get();
        $series = Series::all();
        $brand = Produk::select('brand')->distinct()->get();
        $toko = Toko::all();

        return view('penyewa.pemesanan.informasiPemesanan', compact('produk', 'fotoproduk', 'series', 'brand', 'toko'));
    }

    public function createOrder(Request $request, $id)
    {
        // Validasi data
        $validator = Validator::make($request->all(), [
            'mulaisewa' => 'required|date',
            'akhirsewa' => 'required|date',
            'size' => 'required|string',
            'nama' => 'required|string',
            'alamat' => 'required|string',
            'metodekirim' => 'required|string',
            'additional_items' => 'required|string' // validasi untuk hidden input additional_items
        ]);

        // Jika validasi gagal, kembali dengan pesan kesalahan
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        // Ambil data yang sudah divalidasi
        $validatedData = $validator->validated();

        // Decode JSON additional items
        $additionalItems = json_decode($validatedData['additional_items'], true);

        // Ambil produk berdasarkan id
        $produk = Produk::findOrFail($id);

        // Hitung total harga
        $hargaKatalog = $produk->harga;
        $hargaCuci = $produk->biaya_cuci ? $produk->biaya_cuci : 0;
        $totalHargaAdditional = collect($additionalItems)->sum('harga');
        $biayaAdmin = ($hargaKatalog + $totalHargaAdditional) * 0.05;
        $totalKatalog = $hargaKatalog + $totalHargaAdditional + $hargaCuci;
        $biayaJaminan = 50000;
        $totalHarga = $hargaKatalog + $totalHargaAdditional + $hargaCuci + $biayaAdmin + $biayaJaminan;

        // Midtrans
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $totalHarga,
            )
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        $randomNumber = '';

        $randomNumber = mt_rand(100000, 999999);

        // Simpan ke tabel Order
        $order = new OrderPenyewaan();
        $order->nomor_order = "ORS" . auth()->user()->id . $produk->id . $randomNumber;
        $order->id_penyewa = auth()->user()->id;
        $order->id_produk = $produk->id;
        $order->ukuran = $request->size;
        $order->tujuan_pengiriman = $request->alamat;
        $order->metode_kirim = $request->metodekirim;
        $order->tanggal_mulai = $request->mulaisewa;
        $order->tanggal_selesai = $request->akhirsewa;
        $order->pembayaran_via = "BCA";
        $order->biaya_cuci = $hargaCuci;
        $order->fee_admin = $biayaAdmin;
        $order->total_harga = $totalKatalog;
        $order->grand_total = $totalHarga;
        $order->jaminan = $biayaJaminan;
        $order->total_penghasilan = $totalKatalog;
        $order->additional = $additionalItems;
        $order->status = "Pending";
        $order->snapToken = $snapToken;
        $order->save();

        return redirect()->route('viewCheckout')->with('success', 'Order berhasil dibuat.');
    }

    public function viewCheckout()
    {

        $checkout = OrderPenyewaan::with('produk')
            ->where('id_penyewa', auth()->user()->id)
            ->where('status', 'Pending')
            ->get();

        return view('penyewa.pemesanan.checkout', compact('checkout'));
    }

    public function updateCheckout(Request $request)
    {
        $checkout = OrderPenyewaan::find($request->nomor_order);
        if ($checkout) {
            $checkout->status = "Menunggu di Proses";
            $checkout->save();
            $redirectUrl = route('viewHistory'); // Assuming 'viewHistory' is the name of your route
            return response()->json(['success' => true, 'redirect_url' => $redirectUrl]);
        }
        return response()->json(['success' => false], 400);
    }

    public function viewDetailPemesanan($orderId)
    {
        $order = OrderPenyewaan::where('nomor_order', $orderId)->first(); // Mengambil satu order berdasarkan nomor order
        if ($order) {
            // Ambil nama produk dan foto produk
            $produk = Produk::findOrFail($order->id_produk);
            $user = User::findOrFail($order->id_penyewa);
            $order->nama_produk = $produk->nama_produk; // Tambahkan kolom nama_produk ke dalam objek order
            $order->foto_produk = $produk->fotoProduk->path; // Tambahkan kolom foto_produk ke dalam objek order
            $order->nama_penyewa = $user->nama;

            // Pastikan additional adalah array
            if (!is_array($order->additional)) {
                $order->additional = json_decode($order->additional, true);
            }
        }

        $order->total_tagihan = $order->total_harga + $order->biaya_cuci + $order->fee_admin + 50000;

        return view('penyewa.transaksi.detailPemesanan', compact('order'));
    }

    public function terimaBarang(Request $request, $orderId)
    {
        $order = OrderPenyewaan::findOrFail($orderId);
        $validator = Validator::make($request->all(), [
            'bukti_diterima' => 'required|max:5120',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $photoPath = $request->file('bukti_diterima')->store('public/bukti_foto');
        $photoPath = Str::replaceFirst('public/', 'storage/', $photoPath);

        $order->bukti_penerimaan = $photoPath;
        $order->tanggal_diterima = today();
        $order->status = "Sedang Berlangsung";
        $order->save();

        return redirect()->route('viewHistory')->with('success', 'Nomor Resi Berhasil di Update');
    }

    public function viewPengembalianBarang($orderId)
    {
        $order = OrderPenyewaan::where('nomor_order', $orderId)->first(); // Mengambil satu order berdasarkan nomor order
        if ($order) {
            // Ambil nama produk dan foto produk
            $produk = Produk::findOrFail($order->id_produk);
            $user = User::findOrFail($order->id_penyewa);
            $order->nama_produk = $produk->nama_produk; // Tambahkan kolom nama_produk ke dalam objek order
            $order->foto_produk = $produk->fotoProduk->path; // Tambahkan kolom foto_produk ke dalam objek order
            $order->nama_penyewa = $user->nama;

            // Pastikan additional adalah array
            if (!is_array($order->additional)) {
                $order->additional = json_decode($order->additional, true);
            }
        }

        $order->total_tagihan = $order->total_harga + $order->biaya_cuci + $order->fee_admin + 50000;

        return view('penyewa.transaksi.detailPengembalian', compact('order'));
    }

    public function returBarang(Request $request, $orderId)
    {

        $order = OrderPenyewaan::findOrFail($orderId);


        $validator = Validator::make($request->all(), [
            'nomor_resi' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $order->nomor_resi = $request->nomor_resi;
        $order->tanggal_pengembalian = today();
        $order->status = "Telah Kembali";
        $order->save();

        return redirect()->route('viewPenyewaanSelesai', ['orderId' => $orderId])->with('success', 'Nomor Resi Berhasil di Update');

    }

    public function viewPenyewaanSelesai($orderId)
    {
        $order = OrderPenyewaan::where('nomor_order', $orderId)->first(); // Mengambil satu order berdasarkan nomor order
        if ($order) {
            // Ambil nama produk dan foto produk
            $produk = Produk::findOrFail($order->id_produk);
            $user = User::findOrFail($order->id_penyewa);
            $order->nama_produk = $produk->nama_produk; // Tambahkan kolom nama_produk ke dalam objek order
            $order->foto_produk = $produk->fotoProduk->path; // Tambahkan kolom foto_produk ke dalam objek order
            $order->nama_penyewa = $user->nama;

            // Pastikan additional adalah array
            if (!is_array($order->additional)) {
                $order->additional = json_decode($order->additional, true);
            }
        }

        $order->total_tagihan = $order->total_harga + $order->biaya_cuci + $order->fee_admin + 50000;

        return view('penyewa.transaksi.detailSelesai', compact('order'));
    }


}