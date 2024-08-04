<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PeraturanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Aturan Pendaftaran dan Identifikasi
        DB::table('peraturan_platform')->insert([
            'Judul' => 'Aturan Pendaftaran dan Identifikasi',
            'Peraturan' => "
<ul><li>Isi identitas dengan identitas asli/resmi (Nama, Alamat, Foto KTP, Nomor HP, Nomor Darurat).</li><li>Sosial media yang dilampirkan adalah akun utama, aktif, dan tidak private.</li><li>Foto profil dilarang mengandung unsur SARA.</li><li>Foto diri wajib merupakan foto dari orang yang sama dengan kartu identitas</li></ul>",
            'Audience' => 'umum',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('peraturan_platform')->insert([
            'Judul' => 'Aturan Pendaftaran dan Identifikasi',
            'Peraturan' => "
<ul><li>Isi identitas dengan identitas asli/resmi (Nama, Alamat, Foto KTP, Nomor HP, Nomor Darurat).</li><li>Sosial media yang dilampirkan adalah akun utama, aktif, dan tidak private.</li><li>Foto diri wajib merupakan foto dari orang yang sama dengan kartu identitas</li></ul>",
            'Audience' => 'penyewa',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('peraturan_platform')->insert([
            'Judul' => 'Aturan Pendaftaran dan Identifikasi',
            'Peraturan' => "
<ul><li>Isi identitas dengan identitas asli/resmi (Nama, Alamat, Foto KTP, Nomor HP).</li><li>Sosial media yang dilampirkan adalah akun toko utama, aktif, dan tidak private.</li></ul>",
            'Audience' => 'pemilik sewa',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Aturan Penyewaan
        DB::table('peraturan_platform')->insert([
            'Judul' => 'Aturan Penyewaan',
            'Peraturan' => "
<ul><li>Minimal order 3 hari.</li><li>Proses penyewaan akan memakan waktu selama 3 hari di luar waktu penyewaan: H-1 penyewaan (pengiriman), H+1 penyewaan (pengembalian), H+1 pengembalian (maintenance barang). Waktu maintenance dapat berubah sewaktu-waktu.</li><li>Penyewaan yang sudah dijadwalkan apabila dibatalkan maka biaya akan hangus.</li><li>Penyewaan yang sudah diproses tidak bisa dibatalkan.</li><li>Kostum yang tidak digunakan pada masa penyewaan tidak bisa di-refund.</li><li>Wajib mengembalikan barang yang disewa tepat waktu.</li><li>Dilarang terburu-buru saat akan menggunakan kostum hingga mengakibatkan kerusakan.</li><li>Kostum boleh digunakan untuk menghadiri event.</li><li>Dilarang mengirimkan kostum dalam keadaan basah dan bau.</li><li>Wajib mengembalikan kostum dengan packing yang aman, disarankan menggunakan bubble wrap/kardus.</li><li>Dilarang meminjamkan kostum kepada orang lain.</li><li>Dianjurkan untuk mencuci kostum (opsional) atau minimal tidak bau sebelum kostum dikembalikan.</li></ul>",
            'Audience' => 'umum',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Aturan Pembayaran dan Deposit
        DB::table('peraturan_platform')->insert([
            'Judul' => 'Aturan Pembayaran dan Deposit',
            'Peraturan' => "
<p><strong>== Uang Deposit ==</strong></p><ul><li>Wajib membayarkan uang deposit senilai Rp50.000.</li><li>Uang deposit akan dikembalikan setelah proses penyewaan selesai jika tidak ada kerusakan pada barang yang disewakan.</li><li>Uang deposit akan digunakan apabila terdapat kerusakan pada barang yang disewakan.</li><li>Apabila nominal kerusakan lebih besar dari nominal deposit, maka denda akan dikenakan kepada penyewa dengan nominal yang sudah dipotong dari uang deposit.</li></ul><p><strong>== Biaya Pengiriman ==</strong></p><ul><li>Jaminan biaya kirim untuk setiap transaksi dimulai dari Rp 30.000.</li><li>Jika jaminan biaya pengiriman tidak mencukupi, maka kekurangan biaya kirim akan dipotong dari deposit penyewa.</li><li>Jika biaya pengiriman berlebih, maka pengguna bisa melakukan penarikan biaya ketika transaksi telah selesai</li></ul><p><strong>== Biaya Transaksi ==</strong></p><ul><li>Setiap transaksi akan dikenakan biaya 5% sebagai biaya operasional platform.</li></ul>",
            'Audience' => 'umum',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Aturan Refund dan Withdraw
        DB::table('peraturan_platform')->insert([
            'Judul' => 'Aturan Refund dan Withdraw',
            'Peraturan' => "
<p><strong>== Aturan Refund ==</strong></p><ul><li>Proses refund akan memakan waktu 1x24 jam setelah permintaan refund disetujui.</li><li>Permintaan refund akan diproses jika pihak pemilik sewa menyetujui (bukti valid).</li><li>Proses refund dilakukan pada hari dan jam kerja (Senin-Jumat) mulai pukul 09.00 - 16.00.</li><li>Permintaan refund yang masuk di luar hari dan jam kerja akan diproses pada hari berikutnya.</li><li>Saldo yang tertulis adalah nominal yang dapat dicairkan.</li><li>Apabila proses refund mengalami kendala atau gagal, silahkan mengajukan tiket dengan kategori refund. Akan diproses dalam 1x24 jam.</li></ul><p><strong>== Aturan Withdraw ==</strong></p><ul><li>Proses withdraw akan memakan waktu 1x24 jam setelah permintaan withdraw disetujui.</li><li>Permintaan withdraw dapat dilakukan 1x24 jam setelah transaksi selesai.</li><li>Proses withdraw dilakukan pada hari dan jam kerja (Senin-Jumat) mulai pukul 09.00 - 16.00.</li><li>Permintaan withdraw yang masuk di luar hari dan jam kerja akan diproses pada hari berikutnya.</li><li>Saldo yang tertulis adalah nominal yang dapat dicairkan.</li><li>Apabila proses withdraw mengalami kendala atau gagal, silahkan mengajukan tiket dengan kategori withdraw. Tiket akan diproses dalam 1x24 jam.</li></ul>",
            'Audience' => 'umum',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('peraturan_platform')->insert([
            'Judul' => 'Aturan Refund dan Withdraw',
            'Peraturan' => "
<ul><li>Proses refund akan memakan waktu 1x24 jam setelah permintaan refund disetujui.</li><li>Permintaan refund akan diproses jika pihak pemilik sewa menyetujui (bukti valid).</li><li>Proses refund dilakukan pada hari dan jam kerja (Senin-Jumat) mulai pukul 09.00 - 16.00.</li><li>Permintaan refund yang masuk di luar hari dan jam kerja akan diproses pada hari berikutnya.</li><li>Saldo yang tertulis adalah nominal yang dapat dicairkan.</li><li>Apabila proses refund mengalami kendala atau gagal, silahkan mengajukan tiket dengan kategori refund. Akan diproses dalam 1x24 jam.</li></ul>",
            'Audience' => 'penyewa',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('peraturan_platform')->insert([
            'Judul' => 'Aturan Refund dan Withdraw',
            'Peraturan' => "
<ul><li>Proses withdraw akan memakan waktu 1x24 jam setelah permintaan withdraw disetujui.</li><li>Permintaan withdraw dapat dilakukan 1x24 jam setelah transaksi selesai.</li><li>Proses withdraw dilakukan pada hari dan jam kerja (Senin-Jumat) mulai pukul 09.00 - 16.00.</li><li>Permintaan withdraw yang masuk di luar hari dan jam kerja akan diproses pada hari berikutnya.</li><li>Saldo yang tertulis adalah nominal yang dapat dicairkan.</li><li>Apabila proses withdraw mengalami kendala atau gagal, silahkan mengajukan tiket dengan kategori withdraw. Tiket akan diproses dalam 1x24 jam.</li></ul>",
            'Audience' => 'pemilik sewa',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Aturan Denda dan Sanksi
        DB::table('peraturan_platform')->insert([
            'Judul' => 'Aturan Denda dan Sanksi',
            'Peraturan' => "
<p><strong>== Denda dan Kerusakan ==</strong></p><ul><li>Denda kerusakan barang karena pemakaian ditentukan oleh pemilik sewa.</li><li>Denda keterlambatan pengembalian barang ditentukan oleh pemilik sewa.</li></ul><p><strong>== Peringatan dan Blacklist ==</strong></p><ul><li>Apabila penyewa belum membayarkan denda dalam waktu 2x24 jam, pihak Kalasewa akan menghubungi dan memberi peringatan pertama serta rating berkurang</li><li>Apabila penyewa belum membayarkan denda setelah lewat 2x24 jam, pihak Kalasewa akan memberikan peringatan terakhir dengan menghubungi seluruh kontak terkait (Email, No HP, No Darurat, Sosial Media). Rating akan berkurang</li><li>Apabila penyewa tidak membayarkan denda, biaya tertunggak, atau kabur, maka akun penyewa akan di-blacklist dan tidak bisa mendaftar lagi untuk seluruh akun terkait di masa mendatang. Pihak penyedia layanan akan menyerahkan kasus beserta seluruh bukti yang valid ke pihak pemilik sewa untuk diajukan kepada pihak yang berwajib. Pihak penyedia layanan tidak bertanggung jawab atas segala kejadian yang terjadi setelah kasus diberikan kepada pihak yang berwajib.</li></ul>",
            'Audience' => 'umum',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Aturan Pemesanan & Penanganan Masalah
        DB::table('peraturan_platform')->insert([
            'Judul' => 'Aturan Pemesanan & Penanganan Masalah',
            'Peraturan' => "
<p><strong>== Proses Pemesanan =</strong></p><ul><li>Apabila pesanan penyewa tidak diproses oleh pemilik sewa dan sudah masuk tanggal penyewaan, maka status pesanan akan dibatalkan. Biaya akan segera di-refund dalam waktu 1x24 jam dengan alasan 'Pesanan tidak diproses'. Pemilik sewa akan dikenakan sanksi berupa teguran dan rating berkurang.</li><li>Proses pemesanan dapat diajukan setelah pembayaran telah dilakukan penyewa</li><li>Lakukan pembayaran dalam waktu 30 menit</li></ul><p><strong>&nbsp;== Proses Ticketing ==</strong></p><ul><li>Seluruh tiket akan diproses dalam waktu 1x24 jam.</li><li>Sertakan bukti yang valid (foto atau video) ketika melakukan ticketing agar tiket dapat diproses.</li><li>Dilarang mengajukan tiket yang telah ditolak lebih dari 2x tanpa alasan yang jelas.</li><li>Jika tetap mengajukan tiket yang telah ditolak lebih dari 2x tanpa alasan yang jelas, maka rating akan dikurangi dan diberikan peringatan.</li></ul>",
            'Audience' => 'umum',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Tanggung Jawab dan Kewajiban Pengguna
        DB::table('peraturan_platform')->insert([
            'Judul' => 'Tanggung Jawab dan Kewajiban Pengguna',
            'Peraturan' => "
<p><strong>== Kewajiban Penyewa ==</strong></p><ul><li>Penyewa wajib menjaga barang yang disewa sebaik mungkin.</li><li>Dilarang merusak, menjual, memotong, mengotori barang yang disewa.</li><li>Segala kerusakan akibat pemakaian dan kehilangan merupakan tanggung jawab penyewa.</li><li>Wajib mengambil foto atau video kondisi barang ketika dikirimkan dan ketika barang sudah sampai, berguna sebagai bukti.</li></ul><p><strong>== Kewajiban Pemilik Sewa ==</strong></p><ul><li>Wajib mengirimkan barang sesuai dengan deskripsi dan permintaan penyewa.</li><li>Wajib mengambil foto atau video kondisi barang ketika dikirimkan dan ketika barang sudah sampai, berguna sebagai bukti.</li><li>Wajib memastikan barang dalam kondisi baik dan layak pakai sebelum disewakan.</li><li>Wajib memberikan informasi kontak yang valid dan dapat dihubungi untuk keperluan komunikasi dengan penyewa.</li><li>Bertanggung jawab atas kerusakan atau kehilangan yang terjadi sebelum barang diterima oleh penyewa.</li></ul><p><strong>== Tanggung Jawab Kalasewa ==</strong></p><ul><li>Pihak Kalasewa berperan sebagai penyedia layanan yang menghubungkan antara pemilik sewa dan penyewa yang ingin menyewa kostum cosplay.</li><li>Pihak penyedia layanan (Kalasewa) tidak bertanggung jawab terhadap segala kerusakan dan kehilangan pada barang yang disewakan.</li><li>Pemilik sewa dan penyedia layanan (Kalasewa) tidak bertanggung jawab apabila terjadi kesalahan di luar kendali pemilik sewa (kurir telat, dll).</li><li>Pihak penyedia layanan (Kalasewa) menyerahkan tanggung jawab dan seluruh bukti kasus kepada pihak pemilik sewa apabila penyewa sudah diberikan peringatan terakhir.</li></ul>",
            'Audience' => 'umum',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('peraturan_platform')->insert([
            'Judul' => 'Tanggung Jawab dan Kewajiban Pengguna',
            'Peraturan' => "
<p><strong>== Kewajiban Penyewa ==</strong></p><ul><li>Penyewa wajib menjaga barang yang disewa sebaik mungkin.</li><li>Dilarang merusak, menjual, memotong, mengotori barang yang disewa.</li><li>Segala kerusakan akibat pemakaian dan kehilangan merupakan tanggung jawab penyewa.</li><li>Wajib mengambil foto atau video kondisi barang ketika dikirimkan dan ketika barang sudah sampai, berguna sebagai bukti.</li></ul><p><strong>== Tanggung Jawab Kalasewa ==</strong></p><ul><li>Pihak Kalasewa berperan sebagai penyedia layanan yang menghubungkan antara pemilik sewa dan penyewa yang ingin menyewa kostum cosplay.</li><li>Pihak penyedia layanan (Kalasewa) tidak bertanggung jawab terhadap segala kerusakan dan kehilangan pada barang yang disewakan.</li><li>Pemilik sewa dan penyedia layanan (Kalasewa) tidak bertanggung jawab apabila terjadi kesalahan di luar kendali pemilik sewa (kurir telat, dll).</li><li>Pihak penyedia layanan (Kalasewa) menyerahkan tanggung jawab dan seluruh bukti kasus kepada pihak pemilik sewa apabila penyewa sudah diberikan peringatan terakhir.</li></ul>",
            'Audience' => 'penyewa',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('peraturan_platform')->insert([
            'Judul' => 'Tanggung Jawab dan Kewajiban Pengguna',
            'Peraturan' => "
<p><strong>== Kewajiban Pemilik Sewa ==</strong></p><ul><li>Wajib mengirimkan barang sesuai dengan deskripsi dan permintaan penyewa.</li><li>Wajib mengambil foto atau video kondisi barang ketika dikirimkan dan ketika barang sudah sampai, berguna sebagai bukti.</li><li>Wajib memastikan barang dalam kondisi baik dan layak pakai sebelum disewakan.</li><li>Wajib memberikan informasi kontak yang valid dan dapat dihubungi untuk keperluan komunikasi dengan penyewa.</li><li>Wajib bertanggung jawab atas kerusakan atau kehilangan yang terjadi sebelum barang diterima oleh penyewa.</li></ul><p><strong>== Tanggung Jawab Kalasewa ==</strong></p><ul><li>Pihak Kalasewa berperan sebagai penyedia layanan yang menghubungkan antara pemilik sewa dan penyewa yang ingin menyewa kostum cosplay.</li><li>Pihak penyedia layanan (Kalasewa) tidak bertanggung jawab terhadap segala kerusakan dan kehilangan pada barang yang disewakan.</li><li>Pemilik sewa dan penyedia layanan (Kalasewa) tidak bertanggung jawab apabila terjadi kesalahan di luar kendali pemilik sewa (kurir telat, dll).</li><li>Pihak penyedia layanan (Kalasewa) menyerahkan tanggung jawab dan seluruh bukti kasus kepada pihak pemilik sewa apabila penyewa sudah diberikan peringatan terakhir.</li></ul>",
            'Audience' => 'pemilik sewa',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}