<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Events\UserChangeProfile;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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
        $penyewa1 = User::create([
            'nama' => 'Afdal Citra Habibi',
            'email' => 'satedummydrive@gmail.com',
            'password' => Hash::make('Penyewa@1234'),
            'no_telp' => '08123456789',
            'no_darurat' => '081234567222',
            'ket_no_darurat' => 'Teman',
            'kode_pos' => '40173',
            'alamat' => 'Jl. Pasir Kaliki No.181, Pamoyanan',
            'kota' => 'Kota Bandung',
            'provinsi' => 'Jawa Barat',
            'link_sosial_media' => 'https://www.instagram.com/',
            'foto_identitas' => 'storage/placeholderSeeder/—Pngtree—ktp residents identity card id_8928715.png',
            'foto_diri' => 'storage/placeholderSeeder/55.jpg',
            'NIK' => '1234567890123456',
            'foto_profil' => 'storage/profiles/profil_default.jpg',
            'role' => 'penyewa',
            'verifyIdentitas' => 'Sudah',
        ]);

        event(new UserChangeProfile($penyewa1));

        $penyewa2 = User::create([
            'nama' => 'Muhammad Sumbul',
            'email' => 'satedummydrive2@gmail.com',
            'password' => Hash::make('Penyewa@1234'),
            'no_telp' => '081234569999',
            'no_darurat' => '08123450000',
            'ket_no_darurat' => 'Kerabat',
            'kode_pos' => '40132',
            'alamat' => 'Jl. Dago No.151A, Lb. Siliwangi, Coblong',
            'kota' => 'Kota Bandung',
            'provinsi' => 'Jawa Barat',
            'link_sosial_media' => 'https://www.instagram.com/',
            'foto_identitas' => 'storage/placeholderSeeder/dc2ebiz-7b0ed39b-8d2e-4551-88bc-7d1f92fd8de5.png',
            'foto_diri' => 'storage/placeholderSeeder/93.jpg',
            'NIK' => '1234567890101010',
            'foto_profil' => 'storage/profiles/profil_default.jpg',
            'role' => 'penyewa',
            'verifyIdentitas' => 'Sudah',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        event(new UserChangeProfile($penyewa2));

        $penyewa3 = User::create([
            'nama' => 'Ismail Ahmad Kanabawi',
            'email' => 'satedummydrive3@gmail.com',
            'password' => Hash::make('Penyewa@1234'),
            'no_telp' => '0812300012911',
            'no_darurat' => '0812340018273',
            'kode_pos' => '40111',
            'alamat' => 'Jl. Sumatera No.1, Braga',
            'kota' => 'Kota Bandung',
            'provinsi' => 'Jawa Barat',
            'link_sosial_media' => 'https://www.instagram.com/',
            'foto_identitas' => 'storage/placeholderSeeder/—Pngtree—ktp residents identity card id_8928715.png',
            'foto_diri' => 'storage/placeholderSeeder/84.jpg',
            'NIK' => '1234567801912821',
            'foto_profil' => 'storage/profiles/profil_default.jpg',
            'role' => 'penyewa',
            'verifyIdentitas' => 'Sudah',
        ]);

        event(new UserChangeProfile($penyewa3));

        // Admin
        $admin = User::create([
            'nama' => 'admin',
            'email' => 'green.project28@gmail.com',
            'password' => Hash::make('Admin@1234'),
            'no_telp' => '085161252804',
            'foto_profil' => 'storage/profiles/profil_default.jpg',
            'role' => 'admin',
            'verifyIdentitas' => 'Sudah',
        ]);

        event(new UserChangeProfile($admin));

        // Super Admin
        $superAdmin = User::create([
            'nama' => 'Super Admin',
            'email' => 'superadmin@kalasewa.com',
            'password' => Hash::make('Superadm@1234'),
            'no_telp' => '088800004444',
            'foto_profil' => 'storage/profiles/profil_default.jpg',
            'role' => 'super_admin',
            'verifyIdentitas' => 'Sudah',
        ]);

        event(new UserChangeProfile($superAdmin));
    }
}