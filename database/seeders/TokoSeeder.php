<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Events\PemilikSewaCreated;
use App\Models\User;

class TokoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Pemilik Sewa
        $user = User::create([
            'nama' => 'pemilik Sewa 1',
            'email' => 'pemiliksewa@example.com',
            'password' => Hash::make('12345678'),
            'no_telp' => '08234567890',
            'kode_pos' => '54321',
            'alamat' => 'Jl. Jalan',
            'kota' => 'Kota Bandung',
            'provinsi' => 'Jawa Barat',
            'link_sosial_media' => 'https://www.instagram.com/',
            'foto_identitas' => 'storage/identitas/9o20ME6FihM4UJHfSOpMrL9h8yA6vx5ucKktklug.png',
            'NIK' => '6543210987654321',
            'foto_profil' => 'storage/placeholderSeeder/toko_raiden.png',
            'role' => 'pemilik_sewa',
            'verifyIdentitas' => 'Sudah',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Seed data toko untuk si pemilik sewa
        DB::table('tokos')->insert([
            'nama_toko' => 'Raidencos',
            'id_user' => $user->id,
            'bio_toko' => 'by @raidenshogun
𝘯𝘦𝘸𝘣𝘪𝘦 𝘣𝘰𝘭𝘦𝘩 𝘳𝘦𝘯𝘵𝘢𝘭 𝘥𝘪𝘴𝘪𝘯𝘪 💃
📍Bandung
✨Repair and Styling available!',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        event(new PemilikSewaCreated($user));

        // Pemilik Sewa
        $user = User::create([
            'nama' => 'pemilik Sewa 2',
            'email' => 'pemiliksewa2@example.com',
            'password' => Hash::make('12345678'),
            'no_telp' => '081271123545',
            'kode_pos' => '54321',
            'alamat' => 'Jl. Jalan',
            'kota' => 'Kota Bandung',
            'provinsi' => 'Jawa Barat',
            'link_sosial_media' => 'https://www.instagram.com/',
            'foto_identitas' => 'storage/identitas/9o20ME6FihM4UJHfSOpMrL9h8yA6vx5ucKktklug.png',
            'NIK' => '61231341312',
            'foto_profil' => 'storage/placeholderSeeder/toko_reservecos.jpg',
            'role' => 'pemilik_sewa',
            'verifyIdentitas' => 'Sudah',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Seed data toko untuk si pemilik sewa
        DB::table('tokos')->insert([
            'nama_toko' => 'Reservecos',
            'id_user' => $user->id,
            'bio_toko' => 'Ready to serve from Bandung❣️
💛 DM for booking
💛 Weekend slow response
💛 CHECK HIGHLIGHT',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        event(new PemilikSewaCreated($user));

        // Pemilik Sewa
        $user = User::create([
            'nama' => 'pemilik Sewa 3',
            'email' => 'pemiliksewa3@example.com',
            'password' => Hash::make('12345678'),
            'no_telp' => '0811012345',
            'kode_pos' => '54321',
            'alamat' => 'Jl. Jalan',
            'kota' => 'Kota Bandung',
            'provinsi' => 'Jawa Barat',
            'link_sosial_media' => 'https://www.instagram.com/',
            'foto_identitas' => 'storage/identitas/9o20ME6FihM4UJHfSOpMrL9h8yA6vx5ucKktklug.png',
            'NIK' => '123456789989898',
            'foto_profil' => 'storage/profiles/profil_default.jpg',
            'role' => 'pemilik_sewa',
            'verifyIdentitas' => 'Sudah',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Seed data toko untuk si pemilik sewa
        DB::table('tokos')->insert([
            'nama_toko' => 'Toko Saya',
            'id_user' => $user->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        event(new PemilikSewaCreated($user));
    }
}