<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Definisikan data produk
        $tokoId = DB::table('tokos')->where('nama_toko', 'Toko Saya')->value('id');
        $Id_series = DB::table('series')->where('series', 'Wuthering Waves')->value('id');

        $produk = [
            'id_toko' => $tokoId, // ID toko tempat produk ini dijual
            'nama_produk' => 'Calcharo Wuthering Waves',
            'id_series' => $Id_series,
            'deskripsi_produk' => 'Wuthering Waves Ges',
            'brand' => 'Taobao',
            'harga' => 10000,
            'gender' => 'Pria',
            'berat_produk' => 1000, // Berat dalam gram
            'ukuran_produk' => json_encode(['L' => ['stok' => 1]]),
            'harga' => 10000, // Contoh ukuran produk dalam format JSON
            'metode_kirim' => json_encode(['JNE', 'JNT']), // Metode pengiriman
            'status_produk' => 'aktif',
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // Insert data produk dan dapatkan ID produk yang baru dibuat
        $produkId = DB::table('produks')->insertGetId($produk);

        // Seed data foto produk
        DB::table('foto_produks')->insert([
            'path' => 'storage/produk/foto_produk/306A9aU9bKjTluMsY4t484QZh5gaPQ5rLktCFddN.jpg', // Path foto produk
            'id_produk' => $produkId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('foto_produks')->insert([
            'path' => 'storage/produk/foto_produk/cECzBGXXh4Xrq9y1oZQIZlAnCL6vRCi4xOatHYwE.jpg', // Path foto produk
            'id_produk' => $produkId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
