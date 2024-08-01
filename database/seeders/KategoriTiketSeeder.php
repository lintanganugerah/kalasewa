<?php

namespace Database\Seeders;

use App\Models\KategoriTiket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriTiketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KategoriTiket::create([
            'nama' => 'Penyewa Bermasalah'
        ]);

        KategoriTiket::create([
            'nama' => 'Lainnya'
        ]);
    }
}
