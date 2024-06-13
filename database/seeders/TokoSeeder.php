<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TokoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ambil ID user dari seeder UsersSeeder yang telah berjalan
        $pemilikSewaId = DB::table('users')->where('email', 'lintanganugerah4@gmail.com')->value('id');

        // Seed data toko untuk si pemilik sewa
        DB::table('tokos')->insert([
            'nama_toko' => 'Toko Saya',
            'saldo_penghasilan' => 0,
            'id_user' => $pemilikSewaId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
