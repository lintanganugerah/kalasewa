<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Produk;
use App\Models\Toko;
use App\Models\FotoProduk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            UsersSeeder::class,
            SeriesSeeder::class,
            TokoSeeder::class,
            ProdukSeeder::class,
            ReviewProdukSeeder::class,
            OrderSeeder::class,
            TujuanRekeningSeeder::class,
        ]);

    }
}
