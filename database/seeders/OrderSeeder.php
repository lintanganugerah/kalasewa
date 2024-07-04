<?php

namespace Database\Seeders;

use App\Models\OrderPenyewaan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];
        $produks = Produk::all(); // Ambil semua data produk

        foreach ($produks as $produk) {
            for ($i = 0; $i < 3; $i++) {
                $idPenyewa = rand(1, 3); // Random antara 1 atau 2
                $idProduk = $produk->id; // Ambil id produk dari model Produk
                $penyewa = User::where('id', $idPenyewa)->first(); // Ambil alamat penyewa
                $nomorOrder = "ORS" . $idPenyewa . $idProduk . time() . rand(1, 1000) + $i; // Generate nomor_order
                $metode_kirim = ["JNE", "Grab", "Go Send", "Paxel", "JNT", "SiCepat"];

                // Ambil harga produk dari model Produk
                $hargaProduk = $produk->harga;
                $totalHarga = $hargaProduk;

                // Ambil data additional_produk jika ada
                if ($produk->additional) {
                    $add = json_decode($produk->additional, true);
                    $randomKey = array_rand($add);
                    $randomHarga = $add[$randomKey];
                    $totalHarga += $randomHarga; // Tambahkan harga additional ke total_harga
                    $add = [
                        $randomKey => $randomHarga
                    ];
                } else {
                    $add = null;
                }

                $fee_admin = $totalHarga * 5 / 100;

                // Buat data untuk disimpan
                DB::table('order_penyewaan')->insert([
                    'nomor_order' => $nomorOrder,
                    'id_penyewa' => $idPenyewa,
                    'id_produk' => $idProduk,
                    'ukuran' => 'Ukuran Produk', // Isi sesuai dengan ukuran produk
                    'tujuan_pengiriman' => "Atas Nama " . $penyewa->nama . " " . $penyewa->no_telp . " " . $penyewa->alamat . "," . $penyewa->kota . "," . $penyewa->provinsi . "," . $penyewa->kode_pos,
                    'metode_kirim' => ['JNE', 'Grab', 'Go Send'][array_rand(['JNE', 'Grab', 'Go Send'])], // Isi sesuai dengan metode pengiriman
                    'tanggal_mulai' => now(),
                    'tanggal_selesai' => now()->addDays(3), // Misalnya tambah 3 hari dari tanggal mulai
                    'pembayaran_via' => 'BCA', // Isi sesuai dengan metode pembayaran
                    'fee_admin' => $fee_admin, // Fee admin 5%
                    'total_harga' => $totalHarga, // Menggunakan harga produk dari model Produk + additional jika ada
                    'jaminan' => rand(50000, 100000),
                    'denda_keterlambatan' => null,
                    'total_penghasilan' => $totalHarga - $fee_admin,
                    'denda_lainnya' => null,
                    'additional' => $add ? json_encode($add) : null, // Encode additional ke format JSON jika ada
                    'tanggal_diterima' => null,
                    'tanggal_pengembalian' => null,
                    'status' => 'Menunggu di Proses',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
    }
}