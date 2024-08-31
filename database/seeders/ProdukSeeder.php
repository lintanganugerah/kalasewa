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
        $tokoId = DB::table('tokos')->where('nama_toko', 'Puyo Cosrent')->value('id');
        $Id_series_ww = DB::table('series')->where('series', 'Wuthering Waves')->value('id');

        $produk = [
            'id_toko' => $tokoId, // ID toko tempat produk ini dijual
            'nama_produk' => 'Calcharo Wuthering Waves',
            'id_series' => $Id_series_ww,
            'deskripsi_produk' => 'Wuthering Waves Ges',
            'brand' => 'Taobao',
            'harga' => 10000,
            'gender' => 'Pria',
            'berat_produk' => 1000, // Berat dalam gram
            'ukuran_produk' => 'L',
            'additional' => json_encode(['Sepatu' => 10000, 'Sword' => 20000]),
            'metode_kirim' => json_encode(['JNE', 'JNT']), // Metode pengiriman
            'status_produk' => 'aktif',
            'created_at' => now(),
            'updated_at' => now(),
        ];

        $produk2 = [
            'id_toko' => $tokoId, // ID toko tempat produk ini dijual
            'nama_produk' => 'Wuthering Waves Verina',
            'id_series' => $Id_series_ww,
            'deskripsi_produk' => 'Wuthering Waves Verina Lesgoooooooooo',
            'brand' => 'Taobao',
            'harga' => 150000,
            'gender' => 'Pria',
            'berat_produk' => 1000, // Berat dalam gram
            'ukuran_produk' => 'XS',
            'additional' => null,
            'metode_kirim' => json_encode(['Go Send', 'Paxel']), // Metode pengiriman
            'status_produk' => 'aktif',
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // Insert data produk dan dapatkan ID produk yang baru dibuat
        $produkId = DB::table('produks')->insertGetId($produk);
        $produkId2 = DB::table('produks')->insertGetId($produk2);

        // Seed data foto produk
        DB::table('foto_produks')->insert([
            'path' => 'storage/placeholderSeeder/306A9aU9bKjTluMsY4t484QZh5gaPQ5rLktCFddN.jpg', // Path foto produk
            'id_produk' => $produkId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('foto_produks')->insert([
            'path' => 'storage/placeholderSeeder/cECzBGXXh4Xrq9y1oZQIZlAnCL6vRCi4xOatHYwE.jpg', // Path foto produk
            'id_produk' => $produkId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('foto_produks')->insert([
            'path' => 'storage/placeholderSeeder/cECzBGXXh4Xrq9y1oZQIZlAnCL6vRCi4xOatHYwE.jpg', // Path foto produk
            'id_produk' => $produkId2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // DARI USER ASLI
        $Id_series_spyx = DB::table('series')->where('series', 'Spy X Family')->value('id');
        $Id_series_genshin = DB::table('series')->where('series', 'Genshin Impact')->value('id');
        $tokoId_raiden = DB::table('tokos')->where('nama_toko', 'Raidencos')->value('id');

        $produk1_raiden = [
            'id_toko' => $tokoId_raiden, // ID toko tempat produk ini dijual
            'nama_produk' => 'Eula Lawrence',
            'id_series' => $Id_series_genshin,
            'deskripsi_produk' => 'Cosplay Eula Lawrence / Genshin Impact
                                    .・。.・゜✭・.・✫・゜・。.
                                    What you will rent?
                                    - Costume size L (Delusion 1/3)
                                    - Acc Costume
                                    - Wig
                                    - Aksesoris Rambut
                                    +50k/ weapon
                                    .・。.・゜✭・.・✫・゜・。.
                                    Price : 225k / 3 day

                                    💃Segera DM admin untuk menanyakan barang masih available atau tidak!',
            'brand' => 'Delusion',
            'grade' => 'Grade 3',
            'harga' => 225000,
            'biaya_cuci' => 20000,
            'brand_wig' => 'Manmei',
            'keterangan_wig' => 'Hard Styling',
            'gender' => 'Wanita',
            'berat_produk' => 2000, // Berat dalam gram
            'ukuran_produk' => 'L',
            'additional' => json_encode(['Weapon' => 50000]),
            'metode_kirim' => json_encode(["Grab", "GoSend", "SiCepat", "Paxel"]), // Metode pengiriman
            'status_produk' => 'aktif',
            'created_at' => now(),
            'updated_at' => now(),
        ];

        $produk2_raiden = [
            'id_toko' => $tokoId_raiden, // ID toko tempat produk ini dijual
            'nama_produk' => 'Anya Forger',
            'id_series' => $Id_series_spyx,
            'deskripsi_produk' => 'Anya Forger / Spy x Family
                                    .・。.・゜✭・.・✫・゜・。.
                                    What you will rent?
                                    - Wig
                                    - Costume (Wetrose)
                                    - Acc Rambut
                                    - Kaos kaki

                                    ✨Size M ( LD 90 LP free) ✨

                                    .・。.・゜✭・.・✫・゜・。.
                                    Price : 50k / 3 day

                                    💃Segera DM admin untuk menanyakan barang masih available atau tidak!',
            'brand' => 'Wetrose',
            'harga' => 50000,
            'biaya_cuci' => 20000,
            'brand_wig' => 'Manmei',
            'keterangan_wig' => 'Soft Styling',
            'gender' => 'Wanita',
            'berat_produk' => 1000, // Berat dalam gram
            'ukuran_produk' => 'M',
            'metode_kirim' => json_encode(["Grab", "GoSend", "Paxel"]), // Metode pengiriman
            'status_produk' => 'aktif',
            'created_at' => now(),
            'updated_at' => now(),
        ];

        $produkId = DB::table('produks')->insertGetId($produk1_raiden);
        $produkId2 = DB::table('produks')->insertGetId($produk2_raiden);

        DB::table('foto_produks')->insert([
            'path' => 'storage/placeholderSeeder/foto_eula1_raiden.png', // Path foto produk
            'id_produk' => $produkId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('foto_produks')->insert([
            'path' => 'storage/placeholderSeeder/foto_eula2_raiden.png', // Path foto produk
            'id_produk' => $produkId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('foto_produks')->insert([
            'path' => 'storage/placeholderSeeder/foto_anya1_raiden.png', // Path foto produk
            'id_produk' => $produkId2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('foto_produks')->insert([
            'path' => 'storage/placeholderSeeder/foto_anya2_raiden.png', // Path foto produk
            'id_produk' => $produkId2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        //TOKO 2

        $tokoId_reserve = DB::table('tokos')->where('nama_toko', 'Reservecos')->value('id');
        $Id_series_haikyuu = DB::table('series')->where('series', 'Haikyuu')->value('id');
        $Id_series_op = DB::table('series')->where('series', 'One Piece')->value('id');

        $produk1_reservecos = [
            'id_toko' => $tokoId_reserve, // ID toko tempat produk ini dijual
            'nama_produk' => 'Kiyoko Shimizu Haikyuu',
            'id_series' => $Id_series_haikyuu,
            'deskripsi_produk' => 'READY FOR RENT

                                Haikyuu – Kiyoko Shimizu
                                Size M | 60k/3 hari

                                +Bola Voli | 10k/3 hari

                                *harga belum termasuk ongkos kirim

                                Cek SnK di Highlight sebelum DM

                                Reserve now❣️',
            'brand' => 'Maker Lokal',
            'harga' => 60000,
            'gender' => 'Wanita',
            'berat_produk' => 2000, // Berat dalam gram
            'ukuran_produk' => 'M',
            'additional' => json_encode(['Bola Voli' => 30000]),
            'metode_kirim' => json_encode(["JNE", "SiCepat", "Paxel"]), // Metode pengiriman
            'status_produk' => 'aktif',
            'created_at' => now(),
            'updated_at' => now(),
        ];

        $produk2_reservecos = [
            'id_toko' => $tokoId_reserve, // ID toko tempat produk ini dijual
            'nama_produk' => 'Boa Hancock One Piece',
            'id_series' => $Id_series_op,
            'deskripsi_produk' => 'READY FOR RENT

                                    One Piece – Boa Hancock
                                    Size L | 130k/3 hari

                                    *harga belum termasuk ongkos kirim

                                    Cek SnK di Highlight sebelum DM

                                    Reserve now❣️',
            'brand' => 'Wetrose',
            'harga' => 50000,
            'gender' => 'Wanita',
            'berat_produk' => 1000, // Berat dalam gram
            'ukuran_produk' => 'M',
            'metode_kirim' => json_encode(["JNE", "SiCepat", "Paxel"]), // Metode pengiriman
            'status_produk' => 'aktif',
            'created_at' => now(),
            'updated_at' => now(),
        ];

        $produkId = DB::table('produks')->insertGetId($produk1_reservecos);
        $produkId2 = DB::table('produks')->insertGetId($produk2_reservecos);

        DB::table('foto_produks')->insert([
            'path' => 'storage/placeholderSeeder/foto_kiyoko1_reservecos.png', // Path foto produk
            'id_produk' => $produkId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('foto_produks')->insert([
            'path' => 'storage/placeholderSeeder/foto_kiyoko2_reservecos.png', // Path foto produk
            'id_produk' => $produkId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('foto_produks')->insert([
            'path' => 'storage/placeholderSeeder/foto_boa1_reservecos.png', // Path foto produk
            'id_produk' => $produkId2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('foto_produks')->insert([
            'path' => 'storage/placeholderSeeder/foto_boa2_reservecos.png', // Path foto produk
            'id_produk' => $produkId2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}