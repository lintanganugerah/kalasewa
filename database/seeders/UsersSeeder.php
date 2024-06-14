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
            'password' => Hash::make('12345678'),
            'no_telp' => '08123456789',
            'no_darurat' => '081234567222',
            'kode_pos' => '12345',
            'alamat' => 'Jl. Disini kawan',
            'kota' => 'Kota Bandung',
            'provinsi' => 'Provinsi Jawa Barat',
            'link_sosial_media' => 'https://www.instagram.com/',
            'foto_identitas' => 'storage/identitas/9o20ME6FihM4UJHfSOpMrL9h8yA6vx5ucKktklug.png',
            'foto_diri' => 'storage/identitas/9o20ME6FihM4UJHfSOpMrL9h8yA6vx5ucKktklug.png',
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
            'password' => Hash::make('12345678'),
            'no_telp' => '08234567890',
            'kode_pos' => '54321',
            'alamat' => 'Jl. Jalan',
            'kota' => 'Kota Bandung',
            'provinsi' => 'Jawa Barat',
            'link_sosial_media' => 'https://www.instagram.com/',
            'foto_identitas' => 'storage/identitas/9o20ME6FihM4UJHfSOpMrL9h8yA6vx5ucKktklug.png',
            'NIK' => '6543210987654321',
            'foto_profil' => 'storage/profiles/profil_default.jpg',
            'role' => 'pemilik_sewa',
            'verifyIdentitas' => 'Sudah',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Admin
        DB::table('users')->insert([
            'nama' => 'admin',
            'email' => 'admin@kalasewa.com',
            'password' => Hash::make('admin1234'),
            'no_telp' => '085161252804',
            // 'no_darurat' => '081234567222',
            // 'kode_pos' => '12345',
            // 'alamat' => 'Jl. Disini kawan',
            // 'kota' => 'Kota Bandung',
            // 'provinsi' => 'Provinsi Jawa Barat',
            // 'link_sosial_media' => 'https://www.instagram.com/',
            // 'foto_identitas' => 'storage/identitas/9o20ME6FihM4UJHfSOpMrL9h8yA6vx5ucKktklug.png',
            // 'NIK' => '1234567890123456',
            'foto_profil' => 'storage/profiles/profil_default.jpg',
            'role' => 'admin',
            'verifyIdentitas' => 'Sudah',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}