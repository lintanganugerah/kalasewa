<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AboutUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('aboutUs')->insert([
            'content' => "<p><strong>Halo Gengs! Selamat datang di Kalasewa,</strong></p><p>platform yang menghubungkan para penggemar cosplay dengan pemilik kostum cosplay di kota Bandung! Kalasewa didirikan dengan visi untuk memudahkan akses ke kostum cosplay bagi para cosplayer dari berbagai latar belakang. Kami menyadari bahwa memiliki kostum cosplay bisa menjadi investasi yang besar, baik dari segi waktu maupun biaya.</p><p>Oleh karena itu, kami hadir untuk menyediakan solusi praktis bagi para cosplayer yang ingin menyewa kostum tanpa harus membeli dan merawatnya sendiri. Kalasewa berperan sebagai penyedia layanan yang menghubungkan pemilik sewa dan penyewa yang ingin menyewa kostum cosplay. Kami menyediakan platform yang aman dan nyaman bagi kedua belah pihak untuk berinteraksi dan bertransaksi. Dengan fitur verifikasi identitas, sistem penilaian kepercayaan, dan mekanisme penyelesaian masalah yang adil. Kami berusaha memastikan pengalaman sewa yang menyenangkan dan bebas dari masalah.</p>",
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}