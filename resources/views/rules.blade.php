@extends('layout.template')
@extends('layout.navbar')

@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('css/wishlist.css') }}" />

<section>
    <div class="main-container container">
        <div class="row py-5">
            <div class="header">
                <img src="{{ asset('images/kalasewa.png') }}" alt="kalasewa" class="header-image">
                <h1>K A L A S E W A</h1>
                <h4>Wujudkan impian cosplaymu bersama-sama!</h4>
            </div>
        </div>

        <h1 class="text-center">ATURAN KALASEWA</h1>
        <h4 class="mt-3"><strong>Aturan Pendaftaran dan Identifikasi</strong></h4>
        <h6><strong>Isi Identitas</strong></h6>
        <p class="mb-3">{!! nl2br(e("- Isi identitas dengan identitas asli/resmi (Nama, Alamat, KTP, Nomor HP, Nomor
            Keluarga).
            - Sosial media yang dilampirkan adalah akun utama, aktif, dan tidak private.
            - Foto profil wajib foto asli dan wajah sesuai kartu identitas.
            - Foto selfie memegang kartu identitas.")) !!}
        </p>

        <h4 class="mt-5"><strong>Aturan Penyewaan</strong></h4>
        <h6><strong>Proses Penyewaan</strong></h6>
        <p class="mb-3">{!! nl2br(e("- Minimal order 3 hari.
            - Proses penyewaan akan memakan waktu selama 3 hari di luar waktu penyewaan: H-1 penyewaan (pengiriman), H+1
            penyewaan (pengembalian), H+1 pengembalian (maintenance barang). Waktu maintenance dapat berubah
            sewaktu-waktu.
            - Penyewaan yang sudah dijadwalkan apabila dibatalkan maka biaya akan hangus.
            - Penyewaan yang sudah diproses tidak bisa dibatalkan.
            - Kostum yang tidak digunakan pada masa penyewaan tidak bisa di-refund.
            - Wajib mengirimkan barang yang disewa tepat waktu.
            - Dilarang terburu-buru saat akan menggunakan kostum hingga mengakibatkan kerusakan.
            - Kostum boleh digunakan untuk menghadiri event.
            - Dilarang mengirimkan kostum dalam keadaan basah dan bau.
            - Wajib mengirimkan kostum dengan packing yang aman, disarankan menggunakan bubble wrap/kardus.
            - Dilarang meminjamkan kostum kepada orang lain.
            - Wajib mencuci kostum (minimal tidak bau) sebelum kostum dikembalikan.
            ")) !!}
        </p>

        <h4 class="mt-5"><strong>Aturan Pembayaran dan Deposit</strong></h4>
        <h6><strong>Uang Deposit</strong></h6>
        <p class="mb-3">{!! nl2br(e("- Wajib membayarkan uang deposit senilai Rp50.000.
            - Uang deposit akan dikembalikan setelah proses penyewaan selesai jika tidak ada kerusakan pada barang yang
            disewakan.
            - Uang deposit akan digunakan apabila terdapat kerusakan pada barang yang disewakan.
            - Apabila nominal kerusakan lebih besar dari nominal deposit, maka denda akan dikenakan kepada penyewa
            dengan nominal yang sudah dikurangi dari uang deposit.
            ")) !!}
        </p>
        <h6><strong>Biaya Transaksi</strong></h6>
        <p class="mb-3">{!! nl2br(e("- Setiap transaksi akan dikenakan biaya 5% sebagai biaya operasional platform.
            ")) !!}
        </p>

        <h4 class="mt-5"><strong>Aturan Refund dan Withdraw</strong></h4>
        <h6><strong>Proses Refund</strong></h6>
        <p class="mb-3">{!! nl2br(e("- Proses refund akan memakan waktu 1x24 jam setelah permintaan refund disetujui.
            - Permintaan refund akan diproses jika pihak pemilik sewa menyetujui (bukti valid).
            - Proses refund dilakukan pada hari dan jam kerja (Senin-Jumat) mulai pukul 09.00 - 16.00.
            - Permintaan refund yang masuk di luar hari dan jam kerja akan diproses pada hari berikutnya.
            - Saldo yang tertulis adalah nominal yang dapat dicairkan (setelah potongan dsb).
            - Apabila proses refund mengalami kendala atau gagal, silahkan mengajukan tiket dengan kategori refund. Akan
            diproses dalam 1x24 jam.
            - Saldo deposit yang tidak direfund dalam waktu 1 bulan maka akan hangus.
            ")) !!}
        </p>
        <h6><strong>Proses Withdraw</strong></h6>
        <p class="mb-3">{!! nl2br(e("- Proses withdraw akan memakan waktu 1x24 jam setelah permintaan withdraw
            disetujui.
            - Permintaan withdraw dapat dilakukan 1x24 jam setelah transaksi selesai.
            - Proses withdraw dilakukan pada hari dan jam kerja (Senin-Jumat) mulai pukul 09.00 - 16.00.
            - Permintaan withdraw yang masuk di luar hari dan jam kerja akan diproses pada hari berikutnya.
            - Saldo yang tertulis adalah nominal yang dapat dicairkan (setelah potongan dsb).
            - Apabila proses withdraw mengalami kendala atau gagal, silahkan mengajukan tiket dengan kategori withdraw.
            Tiket akan diproses dalam 1x24 jam.
            ")) !!}
        </p>

        <h4 class="mt-5"><strong>Aturan Sanksi dan Kepercayaan</strong></h4>
        <h6><strong>Denda dan Kerusakan</strong></h6>
        <p class="mb-3">{!! nl2br(e("- Denda kerusakan barang karena pemakaian ditentukan oleh pemilik sewa.
            - Denda keterlambatan pengembalian barang ditentukan oleh pemilik sewa.
            ")) !!}
        </p>
        <h6><strong>Peringatan dan Blacklist</strong></h6>
        <p class="mb-3">{!! nl2br(e("- Apabila penyewa belum membayarkan denda dalam waktu 2x24 jam, pihak Kalasewa akan
            menghubungi dan memberi peringatan pertama. Poin kepercayaan akan berkurang 100.
            - Apabila penyewa belum membayarkan denda setelah lewat 2x24 jam, pihak Kalasewa akan memberikan peringatan
            terakhir dengan menghubungi seluruh kontak terkait (Email, No HP, No Keluarga, Sosial Media). Poin
            kepercayaan akan berkurang 250.
            - Apabila penyewa tidak membayarkan denda, biaya tertunggak, atau kabur, maka akun penyewa akan di-blacklist
            dan tidak bisa mendaftar lagi untuk seluruh akun terkait di masa mendatang. Pihak penyedia layanan akan
            menyerahkan kasus beserta seluruh bukti yang valid ke pihak pemilik sewa untuk diajukan kepada pihak yang
            berwajib. Pihak penyedia layanan tidak bertanggung jawab atas segala kejadian yang terjadi setelah kasus
            diberikan kepada pihak yang berwajib.
            ")) !!}
        </p>

        <h4 class="mt-5"><strong>Aturan Pemesanan dan Penanganan Masalah</strong></h4>
        <h6><strong>Proses Pemesanan</strong></h6>
        <p class="mb-3">{!! nl2br(e("- Apabila pesanan penyewa tidak diproses oleh pemilik sewa dan sudah masuk tanggal
            penyewaan, maka status pesanan akan dibatalkan. Biaya akan segera di-refund dalam waktu 1x24 jam dengan
            alasan 'Pesanan tidak diproses'. Pemilik sewa akan dikenakan sanksi berupa teguran dan poin kepercayaan akan
            berkurang 100.
            ")) !!}
        </p>
        <h6><strong>Proses Ticketing</strong></h6>
        <p class="mb-3">{!! nl2br(e("- Seluruh tiket akan diproses dalam waktu 1x24 jam.
            - Sertakan bukti yang valid (foto atau video) ketika melakukan ticketing agar tiket dapat diproses.
            - Dilarang mengajukan tiket yang telah ditolak lebih dari 2x tanpa alasan yang jelas.
            - Jika tetap mengajukan tiket yang telah ditolak lebih dari 2x tanpa alasan yang jelas, maka poin
            kepercayaan pengguna akan dikurangi 100 poin dan diberikan peringatan.
            ")) !!}
        </p>

        <h4 class="mt-5"><strong>Tanggung Jawab dan Kewajiban Pengguna</strong></h4>
        <h6><strong>Kewajiban Penyewa</strong></h6>
        <p class="mb-3">{!! nl2br(e("- Penyewa wajib menjaga barang yang disewa sebaik mungkin.
            - Dilarang merusak, menjual, memotong, mengotori barang yang disewa.
            - Segala kerusakan akibat pemakaian dan kehilangan merupakan tanggung jawab penyewa.
            - Wajib mengambil foto atau video kondisi barang ketika dikirimkan dan ketika barang sudah sampai, berguna
            sebagai bukti.
            - Wajib mengirimkan barang sesuai dengan deskripsi dan permintaan penyewa.
            ")) !!}
        </p>
        <h6><strong>Tanggung Jawab Kalasewa</strong></h6>
        <p class="mb-3">{!! nl2br(e("- Pihak Kalasewa berperan sebagai penyedia layanan yang menghubungkan antara
            pemilik sewa dan penyewa yang ingin menyewa kostum cosplay.
            - Pihak penyedia layanan (Kalasewa) tidak bertanggung jawab terhadap segala kerusakan dan kehilangan pada
            barang yang disewakan.
            - Pemilik sewa dan penyedia layanan (Kalasewa) tidak bertanggung jawab apabila terjadi kesalahan di luar
            kendali pemilik sewa (kurir telat, dll).
            - Pihak penyedia layanan (Kalasewa) menyerahkan tanggung jawab dan seluruh bukti kasus kepada pihak pemilik
            sewa apabila penyewa sudah diberikan peringatan terakhir.
            ")) !!}
        </p>
    </div>
</section>

@include('layout.footer')
@endsection