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
                'komentar' => 'Cukup memuaskan, tapi kostum agak kusut dikit. Tapi pemilik fast respon banget kok!!',
                'nilai' => 4,
                'foto' => [
                    'storage/placeholderSeeder/agak_kusut.jpg',
                ],
                'tipe' => 'review_produk',
            ],
            [
                'komentar' => 'Kostum bagus bangeeet!! Toko ramah juga. Rekomended',
                'nilai' => 4,
                'foto' => [
                    'storage/placeholderSeeder/images.jpg'
                ],
                'tipe' => 'review_produk',
            ],
            [
                'komentar' => 'Produknya oke, tapi kualitasnya sedikit berbeda dari deskripsi',
                'nilai' => 3,
                'foto' => [
                    'storage/placeholderSeeder/453860711_122197333004074973_4015062407643309467_n.jpg',
                    'storage/placeholderSeeder/453536248_122197333148074973_2440346673930016402_n.jpg',
                    'storage/placeholderSeeder/453724230_122197333202074973_2582092809841044462_n.jpg'
                ],
                'tipe' => 'review_produk',
            ],
            [
                'komentar' => 'Harga terjangkau dan kualitas bagus.',
                'nilai' => 5,
                'foto' => [
                    'storage/placeholderSeeder/453996260_1862289844251222_5496497118193465419_n.jpg'
                ],
                'tipe' => 'review_produk',
            ],
        ];

        $reviewsPenyewa = [
            [
                'komentar' => 'Penyewa Bagus dalam menghandle barang!',
                'nilai' => 5,
                'foto' => [
                    'storage/placeholderSeeder/454283353_476689554982923_1472774036155417931_n.jpg',
                    'storage/placeholderSeeder/453724230_122197333202074973_2582092809841044462_n.jpg'
                ],
                'tipe' => 'review_penyewa',
            ],
            [
                'komentar' => 'Cukup memuaskan, tapi ada wig kusut sedikit, cuman gapapa lah ya',
                'nilai' => 4,
                'foto' => [
                    'storage/placeholderSeeder/454283353_476689554982923_1472774036155417931_n.jpg',
                    'storage/placeholderSeeder/453724230_122197333202074973_2582092809841044462_n.jpg'
                ],
                'tipe' => 'review_penyewa',
            ],
            [
                'komentar' => 'Denda sudah dibayarkan sih, cuman lain kali hati hati aja!!',
                'nilai' => 4,
                'foto' => [
                    'storage/placeholderSeeder/453808037_481202401278885_8439578270115287184_n.jpg'
                ],
                'tipe' => 'review_penyewa',
            ],
            [
                'komentar' => 'Dabest lah!!',
                'nilai' => 5,
                'foto' => [
                    'storage/placeholderSeeder/agak_kusut.jpg'
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