<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Produk;
use App\Models\Review;

class ReviewProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $reviews = [
            [
                'komentar' => 'Produk ini sangat bagus!',
                'nilai' => 5,
                'foto' => [
                    'storage/placeholderSeeder/600x400.png',
                    'storage/placeholderSeeder/1080x1920.png'
                ],
                'tipe' => 'review_produk',
            ],
            [
                'komentar' => 'Cukup memuaskan, tapi masih ada ruang untuk perbaikan.',
                'nilai' => 4,
                'foto' => [
                    'storage/placeholderSeeder/1920x1920.png',
                    'storage/placeholderSeeder/1920x1080.png'
                ],
                'tipe' => 'review_produk',
            ],
            [
                'komentar' => 'Tidak sesuai dengan harapan saya.',
                'nilai' => 2,
                'foto' => [
                    'storage/placeholderSeeder/600x400.png'
                ],
                'tipe' => 'review_produk',
            ],
            [
                'komentar' => 'Sangat mengecewakan, kualitas buruk.',
                'nilai' => 1,
                'foto' => [
                    'storage/placeholderSeeder/1920x1920.png',
                    'storage/placeholderSeeder/1920x1080.png',
                    'storage/placeholderSeeder/1080x1920.png'
                ],
                'tipe' => 'review_produk',
            ],
            [
                'komentar' => 'Harga terjangkau dan kualitas bagus.',
                'nilai' => 5,
                'foto' => [
                    'storage/placeholderSeeder/1080x1920.png'
                ],
                'tipe' => 'review_produk',
            ],
        ];

        $reviewsPenyewa = [
            [
                'komentar' => 'Penyewa Bagus dalam menghandle barang!',
                'nilai' => 5,
                'foto' => [
                    'storage/placeholderSeeder/600x400.png',
                    'storage/placeholderSeeder/1080x1920.png'
                ],
                'tipe' => 'review_penyewa',
            ],
            [
                'komentar' => 'Cukup memuaskan, tapi ada wig kusut sedikit, cuman gapapa lah ya',
                'nilai' => 4,
                'foto' => [
                    'storage/placeholderSeeder/1920x1920.png',
                    'storage/placeholderSeeder/1920x1080.png'
                ],
                'tipe' => 'review_penyewa',
            ],
            [
                'komentar' => 'Tidak bisa menghandle barang!! Denda sudah dibayarkan sih, cuman lain kali hati hati aja!!',
                'nilai' => 2,
                'foto' => [
                    'storage/placeholderSeeder/600x400.png'
                ],
                'tipe' => 'review_penyewa',
            ],
            [
                'komentar' => 'Sangat mengecewakan, kualitas buruk.',
                'nilai' => 1,
                'foto' => [
                    'storage/placeholderSeeder/1920x1920.png',
                    'storage/placeholderSeeder/1920x1080.png',
                    'storage/placeholderSeeder/1080x1920.png'
                ],
                'tipe' => 'review_penyewa',
            ],
            [
                'komentar' => 'Dabest lah!!',
                'nilai' => 5,
                'foto' => [
                    'storage/placeholderSeeder/1080x1920.png'
                ],
                'tipe' => 'review_penyewa',
            ],
        ];

        foreach ($reviews as $review) {
            $reviewProduk = Review::create([
                'id_penyewa' => mt_rand(1, 3),
                'id_toko' => mt_rand(1, 2),
                // 'id_produk' => mt_rand(1, 2),
                'komentar' => $review['komentar'],
                'nilai' => $review['nilai'],
                'foto' => json_encode($review['foto'], JSON_UNESCAPED_SLASHES), // Buat array ke JSON tanpa slashes
                'tipe' => $review['tipe'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $produk = Produk::where('id_toko', $reviewProduk->id_toko)->get();
            $count = $produk->count();
            $reviewProduk->id_produk = $produk[mt_rand($count - 2, $count - 1)]->id;
            $reviewProduk->save();
        }

        foreach ($reviewsPenyewa as $review) {
            DB::table('review')->insert([
                'id_penyewa' => mt_rand(1, 2),
                'id_toko' => mt_rand(1, 2),
                'komentar' => $review['komentar'],
                'nilai' => $review['nilai'],
                'foto' => json_encode($review['foto'], JSON_UNESCAPED_SLASHES), // Buat array ke JSON tanpa slashes
                'tipe' => $review['tipe'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}