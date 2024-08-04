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
• Isi identitas dengan identitas asli/resmi (Nama, Alamat, Foto KTP, Nomor HP, Nomor Darurat).
• Sosial media yang dilampirkan adalah akun utama, aktif, dan tidak private.
• Foto profil dilarang mengandung unsur SARA.
• Foto diri wajib merupakan foto dari orang yang sama dengan kartu identitas",
            'Audience' => 'umum',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('peraturan_platform')->insert([
            'Judul' => 'Aturan Pendaftaran dan Identifikasi',
            'Peraturan' => "
• Isi identitas dengan identitas asli/resmi (Nama, Alamat, Foto KTP, Nomor HP, Nomor Darurat).
• Sosial media yang dilampirkan adalah akun utama, aktif, dan tidak private.
• Foto diri wajib merupakan foto dari orang yang sama dengan kartu identitas",
            'Audience' => 'penyewa',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('peraturan_platform')->insert([
            'Judul' => 'Aturan Pendaftaran dan Identifikasi',
            'Peraturan' => "
• Isi identitas dengan identitas asli/resmi (Nama, Alamat, Foto KTP, Nomor HP).
• Sosial media yang dilampirkan adalah akun toko utama, aktif, dan tidak private.",
            'Audience' => 'pemilik sewa',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Aturan Penyewaan
        DB::table('peraturan_platform')->insert([
            'Judul' => 'Aturan Penyewaan',
            'Peraturan' => "
• Minimal order 3 hari.
• Proses penyewaan akan memakan waktu selama 3 hari di luar waktu penyewaan: H-1 penyewaan (pengiriman), H+1 penyewaan (pengembalian), H+1 pengembalian (maintenance barang). Waktu maintenance dapat berubah sewaktu-waktu.
• Penyewaan yang sudah dijadwalkan apabila dibatalkan maka biaya akan hangus.
• Penyewaan yang sudah diproses tidak bisa dibatalkan.
• Kostum yang tidak digunakan pada masa penyewaan tidak bisa di-refund.
• Wajib mengembalikan barang yang disewa tepat waktu.
• Dilarang terburu-buru saat akan menggunakan kostum hingga mengakibatkan kerusakan.
• Kostum boleh digunakan untuk menghadiri event.
• Dilarang mengirimkan kostum dalam keadaan basah dan bau.
• Wajib mengembalikan kostum dengan packing yang aman, disarankan menggunakan bubble wrap/kardus.
• Dilarang meminjamkan kostum kepada orang lain.
• Wajib mencuci kostum (minimal tidak bau) sebelum kostum dikembalikan.",
            'Audience' => 'umum',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Aturan Pembayaran dan Deposit
        DB::table('peraturan_platform')->insert([
            'Judul' => 'Aturan Pembayaran dan Deposit',
            'Peraturan' => "
== Uang Deposit ==
• Wajib membayarkan uang deposit senilai Rp50.000.
• Uang deposit akan dikembalikan setelah proses penyewaan selesai jika tidak ada kerusakan pada barang yang disewakan.
• Uang deposit akan digunakan apabila terdapat kerusakan pada barang yang disewakan.
• Apabila nominal kerusakan lebih besar dari nominal deposit, maka denda akan dikenakan kepada penyewa dengan nominal yang sudah dipotong dari uang deposit.

== Biaya Transaksi ==
• Setiap transaksi akan dikenakan biaya 5% sebagai biaya operasional platform.",
            'Audience' => 'umum',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Aturan Refund dan Withdraw
        DB::table('peraturan_platform')->insert([
            'Judul' => 'Aturan Refund dan Withdraw',
            'Peraturan' => "
== Aturan Refund ==
• Proses refund akan memakan waktu 1x24 jam setelah permintaan refund disetujui.
• Permintaan refund akan diproses jika pihak pemilik sewa menyetujui (bukti valid).
• Proses refund dilakukan pada hari dan jam kerja (Senin-Jumat) mulai pukul 09.00 - 16.00.
• Permintaan refund yang masuk di luar hari dan jam kerja akan diproses pada hari berikutnya.
• Saldo yang tertulis adalah nominal yang dapat dicairkan.
• Apabila proses refund mengalami kendala atau gagal, silahkan mengajukan tiket dengan kategori refund. Akan diproses dalam 1x24 jam.

== Aturan Withdraw ==
• Proses withdraw akan memakan waktu 1x24 jam setelah permintaan withdraw disetujui.
• Permintaan withdraw dapat dilakukan 1x24 jam setelah transaksi selesai.
• Proses withdraw dilakukan pada hari dan jam kerja (Senin-Jumat) mulai pukul 09.00 - 16.00.
• Permintaan withdraw yang masuk di luar hari dan jam kerja akan diproses pada hari berikutnya.
• Saldo yang tertulis adalah nominal yang dapat dicairkan.
• Apabila proses withdraw mengalami kendala atau gagal, silahkan mengajukan tiket dengan kategori withdraw. Tiket akan diproses dalam 1x24 jam.",
            'Audience' => 'umum',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('peraturan_platform')->insert([
            'Judul' => 'Aturan Refund dan Withdraw',
            'Peraturan' => "
• Proses refund akan memakan waktu 1x24 jam setelah permintaan refund disetujui.
• Permintaan refund akan diproses jika pihak pemilik sewa menyetujui (bukti valid).
• Proses refund dilakukan pada hari dan jam kerja (Senin-Jumat) mulai pukul 09.00 - 16.00.
• Permintaan refund yang masuk di luar hari dan jam kerja akan diproses pada hari berikutnya.
• Saldo yang tertulis adalah nominal yang dapat dicairkan.
• Apabila proses refund mengalami kendala atau gagal, silahkan mengajukan tiket dengan kategori refund. Akan diproses dalam 1x24 jam.
• Saldo deposit yang tidak direfund dalam waktu 1 bulan maka akan hangus.",
            'Audience' => 'penyewa',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('peraturan_platform')->insert([
            'Judul' => 'Aturan Refund dan Withdraw',
            'Peraturan' => "
• Proses withdraw akan memakan waktu 1x24 jam setelah permintaan withdraw disetujui.
• Permintaan withdraw dapat dilakukan 1x24 jam setelah transaksi selesai.
• Proses withdraw dilakukan pada hari dan jam kerja (Senin-Jumat) mulai pukul 09.00 - 16.00.
• Permintaan withdraw yang masuk di luar hari dan jam kerja akan diproses pada hari berikutnya.
• Saldo yang tertulis adalah nominal yang dapat dicairkan.
• Apabila proses withdraw mengalami kendala atau gagal, silahkan mengajukan tiket dengan kategori withdraw. Tiket akan diproses dalam 1x24 jam.",
            'Audience' => 'pemilik sewa',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Aturan Denda dan Sanksi
        DB::table('peraturan_platform')->insert([
            'Judul' => 'Aturan Denda dan Sanksi',
            'Peraturan' => "
== Denda dan Kerusakan ==
• Denda kerusakan barang karena pemakaian ditentukan oleh pemilik sewa.
• Denda keterlambatan pengembalian barang ditentukan oleh pemilik sewa.

== Peringatan dan Blacklist ==
• Apabila penyewa belum membayarkan denda dalam waktu 2x24 jam, pihak Kalasewa akan menghubungi dan memberi peringatan pertama serta rating berkurang
• Apabila penyewa belum membayarkan denda setelah lewat 2x24 jam, pihak Kalasewa akan memberikan peringatan terakhir dengan menghubungi seluruh kontak terkait (Email, No HP, No Darurat, Sosial Media). Rating akan berkurang
• Apabila penyewa tidak membayarkan denda, biaya tertunggak, atau kabur, maka akun penyewa akan di-blacklist dan tidak bisa mendaftar lagi untuk seluruh akun terkait di masa mendatang. Pihak penyedia layanan akan menyerahkan kasus beserta seluruh bukti yang valid ke pihak pemilik sewa untuk diajukan kepada pihak yang berwajib. Pihak penyedia layanan tidak bertanggung jawab atas segala kejadian yang terjadi setelah kasus diberikan kepada pihak yang berwajib.",
            'Audience' => 'umum',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Aturan Pemesanan & Penanganan Masalah
        DB::table('peraturan_platform')->insert([
            'Judul' => 'Aturan Pemesanan & Penanganan Masalah',
            'Peraturan' => "
== Proses Pemesanan ==
• Apabila pesanan penyewa tidak diproses oleh pemilik sewa dan sudah masuk tanggal penyewaan, maka status pesanan akan dibatalkan. Biaya akan segera di-refund dalam waktu 1x24 jam dengan alasan \"Pesanan tidak diproses\". Pemilik sewa akan dikenakan sanksi berupa teguran dan rating berkurang.
• Proses pemesanan dapat diajukan setelah pembayaran telah dilakukan penyewa
• Lakukan pembayaran dalam waktu 30 menit

== Proses Ticketing ==
• Seluruh tiket akan diproses dalam waktu 1x24 jam.
• Sertakan bukti yang valid (foto atau video) ketika melakukan ticketing agar tiket dapat diproses.
• Dilarang mengajukan tiket yang telah ditolak lebih dari 2x tanpa alasan yang jelas.
• Jika tetap mengajukan tiket yang telah ditolak lebih dari 2x tanpa alasan yang jelas, maka rating akan dikurangi dan diberikan peringatan.",
            'Audience' => 'umum',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Tanggung Jawab dan Kewajiban Pengguna
        DB::table('peraturan_platform')->insert([
            'Judul' => 'Tanggung Jawab dan Kewajiban Pengguna',
            'Peraturan' => "
== Kewajiban Penyewa ==
• Penyewa wajib menjaga barang yang disewa sebaik mungkin.
• Dilarang merusak, menjual, memotong, mengotori barang yang disewa.
• Segala kerusakan akibat pemakaian dan kehilangan merupakan tanggung jawab penyewa.
• Wajib mengambil foto atau video kondisi barang ketika dikirimkan dan ketika barang sudah sampai, berguna sebagai bukti.

== Kewajiban Pemilik Sewa ==
• Wajib mengirimkan barang sesuai dengan deskripsi dan permintaan penyewa.
• Wajib mengambil foto atau video kondisi barang ketika dikirimkan dan ketika barang sudah sampai, berguna sebagai bukti.
• Wajib memastikan barang dalam kondisi baik dan layak pakai sebelum disewakan.
• Wajib memberikan informasi kontak yang valid dan dapat dihubungi untuk keperluan komunikasi dengan penyewa.
• Bertanggung jawab atas kerusakan atau kehilangan yang terjadi sebelum barang diterima oleh penyewa.

== Tanggung Jawab Kalasewa ==
• Pihak Kalasewa berperan sebagai penyedia layanan yang menghubungkan antara pemilik sewa dan penyewa yang ingin menyewa kostum cosplay.
• Pihak penyedia layanan (Kalasewa) tidak bertanggung jawab terhadap segala kerusakan dan kehilangan pada barang yang disewakan.
• Pemilik sewa dan penyedia layanan (Kalasewa) tidak bertanggung jawab apabila terjadi kesalahan di luar kendali pemilik sewa (kurir telat, dll).
• Pihak penyedia layanan (Kalasewa) menyerahkan tanggung jawab dan seluruh bukti kasus kepada pihak pemilik sewa apabila penyewa sudah diberikan peringatan terakhir.",
            'Audience' => 'umum',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('peraturan_platform')->insert([
            'Judul' => 'Tanggung Jawab dan Kewajiban Pengguna',
            'Peraturan' => "
== Kewajiban Penyewa ==
• Penyewa wajib menjaga barang yang disewa sebaik mungkin.
• Dilarang merusak, menjual, memotong, mengotori barang yang disewa.
• Segala kerusakan akibat pemakaian dan kehilangan merupakan tanggung jawab penyewa.
• Wajib mengambil foto atau video kondisi barang ketika dikirimkan dan ketika barang sudah sampai, berguna sebagai bukti.

== Tanggung Jawab Kalasewa ==
• Pihak Kalasewa berperan sebagai penyedia layanan yang menghubungkan antara pemilik sewa dan penyewa yang ingin menyewa kostum cosplay.
• Pihak penyedia layanan (Kalasewa) tidak bertanggung jawab terhadap segala kerusakan dan kehilangan pada barang yang disewakan.
• Pemilik sewa dan penyedia layanan (Kalasewa) tidak bertanggung jawab apabila terjadi kesalahan di luar kendali pemilik sewa (kurir telat, dll).
• Pihak penyedia layanan (Kalasewa) menyerahkan tanggung jawab dan seluruh bukti kasus kepada pihak pemilik sewa apabila penyewa sudah diberikan peringatan terakhir.",
            'Audience' => 'penyewa',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('peraturan_platform')->insert([
            'Judul' => 'Tanggung Jawab dan Kewajiban Pengguna',
            'Peraturan' => "
== Kewajiban Pemilik Sewa ==
• Wajib mengirimkan barang sesuai dengan deskripsi dan permintaan penyewa.
• Wajib mengambil foto atau video kondisi barang ketika dikirimkan dan ketika barang sudah sampai, berguna sebagai bukti.
• Wajib memastikan barang dalam kondisi baik dan layak pakai sebelum disewakan.
• Wajib memberikan informasi kontak yang valid dan dapat dihubungi untuk keperluan komunikasi dengan penyewa.
• Bertanggung jawab atas kerusakan atau kehilangan yang terjadi sebelum barang diterima oleh penyewa.

== Tanggung Jawab Kalasewa ==
• Pihak Kalasewa berperan sebagai penyedia layanan yang menghubungkan antara pemilik sewa dan penyewa yang ingin menyewa kostum cosplay.
• Pihak penyedia layanan (Kalasewa) tidak bertanggung jawab terhadap segala kerusakan dan kehilangan pada barang yang disewakan.
• Pemilik sewa dan penyedia layanan (Kalasewa) tidak bertanggung jawab apabila terjadi kesalahan di luar kendali pemilik sewa (kurir telat, dll).
• Pihak penyedia layanan (Kalasewa) menyerahkan tanggung jawab dan seluruh bukti kasus kepada pihak pemilik sewa apabila penyewa sudah diberikan peringatan terakhir.",
            'Audience' => 'pemilik sewa',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}