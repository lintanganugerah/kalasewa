<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Penyewa
        DB::table('users')->insert([
            'nama' => 'Penyewa Satu',
            'email' => 'penyewa@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'no_telp' => '08123456789',
            'kode_pos' => '12345',
            'alamat' => 'Jl. Disini kawan',
            'kota' => 'Kota Bandung',
            'provinsi' => 'Provinsi Jawa Barat',
            'identitas' => 'storage/data/9o20ME6FihM4UJHfSOpMrL9h8yA6vx5ucKktklug.png',
            'NIK' => '1234567890123456',
            'foto_profil' => 'storage/profiles/profil_default.jpg',
            'role' => 'penyewa',
            'verifyIdentitas' => 'Sudah',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Pemilik Sewa
        DB::table('users')->insert([
            'nama' => 'Lintang',
            'email' => 'lintanganugerah4@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'no_telp' => '08234567890',
            'kode_pos' => '54321',
            'alamat' => 'Jl. Jalan',
            'kota' => 'Kota Bandung',
            'provinsi' => 'Jawa Barat',
            'identitas' => 'storage/data/9o20ME6FihM4UJHfSOpMrL9h8yA6vx5ucKktklug.png',
            'NIK' => '6543210987654321',
            'foto_profil' => 'storage/profiles/profil_default.jpg',
            'role' => 'pemilik_sewa',
            'verifyIdentitas' => 'Sudah',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
