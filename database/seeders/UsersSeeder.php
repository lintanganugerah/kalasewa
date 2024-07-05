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
            'nama' => 'Penyewa 1',
            'email' => 'penyewa@example.com',
            'password' => Hash::make('12345678'),
            'no_telp' => '08123456789',
            'no_darurat' => '081234567222',
            'ket_no_darurat' => 'Teman',
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

        DB::table('users')->insert([
            'nama' => 'Penyewa 2',
            'email' => 'penyewa2@example.com',
            'password' => Hash::make('12345678'),
            'no_telp' => '081234569999',
            'no_darurat' => '08123450000',
            'ket_no_darurat' => 'Kerabat',
            'kode_pos' => '12345',
            'alamat' => 'Jl. Disini kawan',
            'kota' => 'Kota Bandung',
            'provinsi' => 'Provinsi Jawa Barat',
            'link_sosial_media' => 'https://www.instagram.com/',
            'foto_identitas' => 'storage/identitas/9o20ME6FihM4UJHfSOpMrL9h8yA6vx5ucKktklug.png',
            'foto_diri' => 'storage/identitas/9o20ME6FihM4UJHfSOpMrL9h8yA6vx5ucKktklug.png',
            'NIK' => '1234567890101010101',
            'foto_profil' => 'storage/profiles/profil_default.jpg',
            'role' => 'penyewa',
            'verifyIdentitas' => 'Sudah',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'nama' => 'Penyewa 3',
            'email' => 'penyewa3@example.com',
            'password' => Hash::make('12345678'),
            'no_telp' => '0812300012911',
            'no_darurat' => '0812340018273',
            'kode_pos' => '12345',
            'alamat' => 'Jl. Disini kawan',
            'kota' => 'Kota Bandung',
            'provinsi' => 'Provinsi Jawa Barat',
            'link_sosial_media' => 'https://www.instagram.com/',
            'foto_identitas' => 'storage/identitas/9o20ME6FihM4UJHfSOpMrL9h8yA6vx5ucKktklug.png',
            'foto_diri' => 'storage/identitas/9o20ME6FihM4UJHfSOpMrL9h8yA6vx5ucKktklug.png',
            'NIK' => '12345678019128211',
            'foto_profil' => 'storage/profiles/profil_default.jpg',
            'role' => 'penyewa',
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
            'foto_profil' => 'storage/profiles/profil_default.jpg',
            'role' => 'admin',
            'verifyIdentitas' => 'Sudah',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Super Admin
        DB::table('users')->insert([
            'nama' => 'Super Admin',
            'email' => 'superadmin@kalasewa.com',
            'password' => Hash::make('superadm'),
            'no_telp' => '088800004444',
            'foto_profil' => 'storage/profiles/profil_default.jpg',
            'role' => 'super_admin',
            'verifyIdentitas' => 'Sudah',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}