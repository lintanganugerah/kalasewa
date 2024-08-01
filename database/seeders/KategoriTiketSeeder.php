<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriTiketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategori = [
            'Transaksi Bermasalah',
            'Laporkan Penyewa / Pemilik Sewa',
            'Proses Refund / Withdraw Bermasalah',
            'Ajukan Banding',
            'Lainnya'
        ];

        foreach ($kategori as $nama) {
            DB::table('kategori_tiket')->insert([
                'nama' => $nama,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
