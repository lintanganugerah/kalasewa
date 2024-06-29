@extends('layout.layout-seller')
@section('content')
    @include('layout.navbar')

    <section style="background-color: #f6f6f6;">
        <div class="px-4 py-5 px-md-5 text-center text-lg-start" style="background-color: hsl(0, 0%, 96%)">
            <div class="container">
                <div class="row gx-lg-5 align-items-center">
                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <h1 class="my-5 display-3 fw-bold ls-tight">
                            Mari mulai berjualan di Kalasewa!
                        </h1>
                        <p style="color: hsl(217, 10%, 50.8%)">Daftar dengan email toko atau pribadi, lalu
                            lakukan registrasi! Mudah hanya dengan beberapa langkah saja.
                        </p>
                    </div>

                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <!-- NAVTABS -->
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="penyewa-tab" href="{{ route('registerViewPenyewa') }}"
                                    role="tab" aria-controls="penyewa" aria-selected="false">Penyewa</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="pemilik-sewa-tab"
                                    href="{{ route('registerViewPemilikSewa') }}" role="tab"
                                    aria-controls="pemilik-sewa" aria-selected="true">Pemilik Sewa</a>
                            </li>
                        </ul>

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="pemilik-sewa" role="tabpanel"
                                aria-labelledby="pemilik-sewa-tab">
                                <!-- FORM PEMILIK SEWA -->
                                <div class="card">
                                    <div class="card-body py-5 px-md-5">
                                        <h3 class="mb-5 fw-bold ls-tight">
                                            Daftar Sebagai Penjual (Pemilik Sewa)
                                        </h3>
                                        <form action="{{ route('checkEmailPemilikSewa') }}" method="POST">
                                            @csrf
                                            @if (session('error'))
                                                <div class="alert alert-danger">
                                                    {{ session('error') }}
                                                </div>
                                            @endif
                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    {{ $errors->first() }}
                                                </div>
                                            @endif
                                            <!-- Form -->
                                            <div data-mdb-input-init class="form-outline mb-4">
                                                <label class="form-label" for="formPemilikEmail">Email address</label>
                                                <input type="email" id="formPemilikEmail" name="email"
                                                    class="form-control" required>
                                                <div id="HELP" class="form-text fw-bolder">Masukan email aktif
                                                    untuk proses verifikasi email
                                                </div>
                                            </div>

                                            <!-- Submit -->
                                            <div class="d-grid mb-5">
                                                <button type="button" class="btn btn-kalasewa" data-bs-toggle="modal"
                                                    data-bs-target="#syaratdanKetentuan">Daftar</button>
                                            </div>

                                            <!-- Login -->
                                            <div class="text-center">
                                                <p>Sudah memiliki akun? <a href="{{ route('loginView') }}"
                                                        class="fw-bold text-dark">Klik untuk Login</a></p>
                                            </div>
                                            <div class="modal fade" id="syaratdanKetentuan" data-bs-backdrop="static"
                                                data-bs-keyboard="false" tabindex="-1"
                                                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="syaratdanKetentuanlLabel">Harap baca
                                                                syarat dan Ketentuan berikut!</h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="syaratKetentuan">
                                                                <h4><strong>Aturan Pendaftaran dan Identifikasi</strong>
                                                                </h4>
                                                                <h6><strong>Isi Identitas Bagi Pemilik Sewa</strong></h6>
                                                                <ul class="mb-3">
                                                                    <li>Isi identitas dengan identitas asli/resmi (Nama,
                                                                        Alamat lengkap, KTP, Nomor HP).</li>
                                                                    <li>Sosial media yang dilampirkan adalah akun toko
                                                                        utama, aktif, dan tidak private.</li>
                                                                </ul>
                                                                <h6><strong>Isi Identitas Bagi Penyewa</strong></h6>
                                                                <ul class="mb-3">
                                                                    <li>Isi identitas dengan identitas asli/resmi (Nama,
                                                                        Alamat, KTP, Nomor HP, Nomor Darurat).</li>
                                                                    <li>Sosial media yang dilampirkan adalah akun utama,
                                                                        aktif, dan tidak private.</li>
                                                                    <li>Foto diri wajib foto asli dan wajah sesuai kartu
                                                                        identitas.</li>
                                                                </ul>

                                                                <h4 class="mt-5"><strong>Aturan Penyewaan</strong></h4>
                                                                <h6><strong>Proses Penyewaan</strong></h6>
                                                                <ul class="mb-3">
                                                                    <li>Default lama sewa adalah 3 hari.</li>
                                                                    <li>Kalasewa menyediakan waktu sewa setiap saat,
                                                                        weekday/weekend.</li>
                                                                    <li>Penyewa paling maksimal memesan H-2 tanggal sewa.
                                                                        Misal penyewa ingin memakai cosplay pada tanggal 16.
                                                                        Maka ia harus memesan pada tanggal 14. Tanggal 15
                                                                        digunakan untuk pengiriman, dan tanggal 19 adalah
                                                                        batas sewa (16 + 3 hari sewa). Jika Penyewa
                                                                        terlambat mengembalikan kostum H+1, yaitu Misal
                                                                        tanggal 20 maka akan dikenakan denda, Lihat poin
                                                                        peraturan denda dibawah
                                                                    </li>
                                                                    <li>Pada kalasewa, Proses penyewaan akan memakan waktu
                                                                        total selama 5 hari di
                                                                        luar waktu penyewaan (3 Hari). Terdapat 2 hari untuk
                                                                        pengiriman dan pengembalian: H-1 penyewaan
                                                                        (pengiriman), Penyewaan Berlangsung (3 Hari), H+1
                                                                        penyewaan (pengembalian), H+1 pengembalian
                                                                        (maintenance barang). Waktu maintenance
                                                                        dapat berubah sewaktu-waktu.</li>
                                                                    <li>Bagi Penyewa, yang sudah dijadwalkan apabila
                                                                        dibatalkan maka biaya akan hangus.</li>
                                                                    <li>Penyewaan yang sudah diproses tidak bisa dibatalkan.
                                                                    </li>
                                                                    <li>Kostum yang tidak digunakan pada masa penyewaan
                                                                        tidak bisa di-refund.</li>
                                                                    <li>Wajib mengirimkan barang yang disewa tepat waktu.
                                                                    </li>
                                                                    <li>Dilarang terburu-buru saat akan menggunakan kostum
                                                                        hingga mengakibatkan kerusakan.</li>
                                                                    <li>Kostum boleh digunakan untuk menghadiri event.</li>
                                                                    <li>Dilarang mengirimkan kostum dalam keadaan basah dan
                                                                        bau.</li>
                                                                    <li>Wajib mengirimkan kostum dengan packing yang aman,
                                                                        disarankan menggunakan bubble wrap/kardus.</li>
                                                                    <li>Dilarang meminjamkan kostum kepada orang lain.</li>
                                                                    <li>Wajib mencuci kostum (minimal tidak bau) sebelum
                                                                        kostum dikembalikan.</li>
                                                                </ul>

                                                                <h4 class="mt-5"><strong>Aturan Pembayaran dan
                                                                        Deposit</strong></h4>
                                                                <h6><strong>Uang Deposit</strong></h6>
                                                                <ul class="mb-3">
                                                                    <li>Wajib membayarkan uang deposit senilai Rp50.000.
                                                                    </li>
                                                                    <li>Uang deposit akan dikembalikan setelah proses
                                                                        penyewaan selesai jika tidak ada kerusakan pada
                                                                        barang yang disewakan.</li>
                                                                    <li>Uang deposit akan digunakan apabila terdapat
                                                                        kerusakan pada barang yang disewakan.</li>
                                                                    <li>Apabila nominal kerusakan lebih besar dari nominal
                                                                        deposit, maka denda akan dikenakan kepada penyewa
                                                                        dengan nominal yang sudah dikurangi dari uang
                                                                        deposit.</li>
                                                                </ul>
                                                                <h6><strong>Biaya Transaksi</strong></h6>
                                                                <ul class="mb-3">
                                                                    <li>Setiap transaksi akan dikenakan biaya 5% sebagai
                                                                        biaya operasional platform.</li>
                                                                </ul>

                                                                <h4 class="mt-5"><strong>Aturan Refund dan
                                                                        Withdraw</strong></h4>
                                                                <h6><strong>Proses Refund</strong></h6>
                                                                <ul class="mb-3">
                                                                    <li>Proses refund akan memakan waktu 1x24 jam setelah
                                                                        permintaan refund disetujui.</li>
                                                                    <li>Permintaan refund akan diproses jika pihak pemilik
                                                                        sewa menyetujui (bukti valid).</li>
                                                                    <li>Proses refund dilakukan pada hari dan jam kerja
                                                                        (Senin-Jumat) mulai pukul 09.00 - 16.00.</li>
                                                                    <li>Permintaan refund yang masuk di luar hari dan jam
                                                                        kerja akan diproses pada hari berikutnya.</li>
                                                                    <li>Saldo yang tertulis adalah nominal yang dapat
                                                                        dicairkan (setelah potongan dsb).</li>
                                                                    <li>Apabila proses refund mengalami kendala atau gagal,
                                                                        silahkan mengajukan tiket dengan kategori refund.
                                                                        Akan diproses dalam 1x24 jam.</li>
                                                                    <li>Saldo deposit yang tidak direfund dalam waktu 1
                                                                        bulan maka akan hangus.</li>
                                                                </ul>
                                                                <h6><strong>Proses Withdraw</strong></h6>
                                                                <ul class="mb-3">
                                                                    <li>Proses withdraw akan memakan waktu 1x24 jam setelah
                                                                        permintaan withdraw disetujui.</li>
                                                                    <li>Permintaan withdraw dapat dilakukan 1x24 jam setelah
                                                                        transaksi selesai.</li>
                                                                    <li>Proses withdraw dilakukan pada hari dan jam kerja
                                                                        (Senin-Jumat) mulai pukul 09.00 - 16.00.</li>
                                                                    <li>Permintaan withdraw yang masuk di luar hari dan jam
                                                                        kerja akan diproses pada hari berikutnya.</li>
                                                                    <li>Saldo yang tertulis adalah nominal yang dapat
                                                                        dicairkan (setelah potongan dsb).</li>
                                                                    <li>Apabila proses withdraw mengalami kendala atau
                                                                        gagal, silahkan mengajukan tiket dengan kategori
                                                                        withdraw. Tiket akan diproses dalam 1x24 jam.</li>
                                                                </ul>

                                                                <h4 class="mt-5"><strong>Aturan Sanksi dan
                                                                        Kepercayaan</strong></h4>
                                                                <h6><strong>Denda dan Kerusakan</strong></h6>
                                                                <ul class="mb-3">
                                                                    <li>Denda kerusakan barang karena pemakaian ditentukan
                                                                        oleh pemilik sewa.</li>
                                                                    <li>Denda keterlambatan pengembalian barang ditentukan
                                                                        oleh pemilik sewa.</li>
                                                                </ul>
                                                                <h6><strong>Peringatan dan Blacklist</strong></h6>
                                                                <ul class="mb-3">
                                                                    <li>Apabila penyewa belum membayarkan denda dalam waktu
                                                                        2x24 jam, pihak Kalasewa akan menghubungi dan
                                                                        memberi peringatan pertama. Poin kepercayaan akan
                                                                        berkurang 100.</li>
                                                                    <li>Apabila penyewa belum membayarkan denda setelah
                                                                        lewat 2x24 jam, pihak Kalasewa akan memberikan
                                                                        peringatan terakhir dengan menghubungi seluruh
                                                                        kontak terkait (Email, No HP, No Keluarga, Sosial
                                                                        Media). Poin kepercayaan akan berkurang 250.</li>
                                                                    <li>Apabila penyewa tidak membayarkan denda, biaya
                                                                        tertunggak, atau kabur, maka akun penyewa akan
                                                                        di-blacklist dan tidak bisa mendaftar lagi untuk
                                                                        seluruh akun terkait di masa mendatang. Pihak
                                                                        penyedia layanan akan menyerahkan kasus beserta
                                                                        seluruh bukti yang valid ke pihak pemilik sewa untuk
                                                                        diajukan kepada pihak yang berwajib. Pihak penyedia
                                                                        layanan tidak bertanggung jawab atas segala kejadian
                                                                        yang terjadi setelah kasus diberikan kepada pihak
                                                                        yang berwajib.</li>
                                                                </ul>

                                                                <h4 class="mt-5"><strong>Aturan Pemesanan dan Penanganan
                                                                        Masalah</strong></h4>
                                                                <h6><strong>Proses Pemesanan</strong></h6>
                                                                <ul class="mb-3">
                                                                    <li>Apabila pesanan penyewa tidak diproses oleh pemilik
                                                                        sewa dan sudah masuk tanggal penyewaan, maka status
                                                                        pesanan akan dibatalkan. Biaya akan segera di-refund
                                                                        dalam waktu 1x24 jam dengan alasan 'Pesanan tidak
                                                                        diproses'. Pemilik sewa akan dikenakan sanksi berupa
                                                                        teguran dan poin kepercayaan akan berkurang 100.
                                                                    </li>
                                                                </ul>
                                                                <h6><strong>Proses Ticketing</strong></h6>
                                                                <ul class="mb-3">
                                                                    <li>Seluruh tiket akan diproses dalam waktu 1x24 jam.
                                                                    </li>
                                                                    <li>Sertakan bukti yang valid (foto atau video) ketika
                                                                        melakukan ticketing agar tiket dapat diproses.</li>
                                                                    <li>Dilarang mengajukan tiket yang telah ditolak lebih
                                                                        dari 2x tanpa alasan yang jelas.</li>
                                                                    <li>Jika tetap mengajukan tiket yang telah ditolak lebih
                                                                        dari 2x tanpa alasan yang jelas, maka poin
                                                                        kepercayaan pengguna akan dikurangi 100 poin dan
                                                                        diberikan peringatan.</li>
                                                                </ul>

                                                                <h4 class="mt-5"><strong>Tanggung Jawab dan Kewajiban
                                                                        Pengguna</strong></h4>
                                                                <h6><strong>Kewajiban Penyewa</strong></h6>
                                                                <ul class="mb-3">
                                                                    <li>Penyewa wajib menjaga barang yang disewa sebaik
                                                                        mungkin.</li>
                                                                    <li>Dilarang merusak, menjual, memotong, mengotori
                                                                        barang yang disewa.</li>
                                                                    <li>Segala kerusakan akibat pemakaian dan kehilangan
                                                                        merupakan tanggung jawab penyewa.</li>
                                                                    <li>Wajib mengambil foto atau video kondisi barang
                                                                        ketika dikirimkan dan ketika barang sudah sampai,
                                                                        berguna sebagai bukti.</li>
                                                                    <li>Wajib mengirimkan barang sesuai dengan deskripsi dan
                                                                        permintaan penyewa.</li>
                                                                </ul>
                                                                <h6><strong>Tanggung Jawab Kalasewa</strong></h6>
                                                                <ul class="mb-3">
                                                                    <li>Pihak Kalasewa berperan sebagai penyedia layanan
                                                                        yang menghubungkan antara pemilik sewa dan penyewa
                                                                        yang ingin menyewa kostum cosplay.</li>
                                                                    <li>Pihak penyedia layanan (Kalasewa) tidak bertanggung
                                                                        jawab terhadap segala kerusakan dan kehilangan pada
                                                                        barang yang disewakan.</li>
                                                                    <li>Pemilik sewa dan penyedia layanan (Kalasewa) tidak
                                                                        bertanggung jawab apabila terjadi kesalahan di luar
                                                                        kendali pemilik sewa (kurir telat, dll).</li>
                                                                    <li>Pihak penyedia layanan (Kalasewa) menyerahkan
                                                                        tanggung jawab dan seluruh bukti kasus kepada pihak
                                                                        pemilik sewa apabila penyewa sudah diberikan
                                                                        peringatan terakhir.</li>
                                                                </ul>
                                                            </div>
                                                            <div class="mb-3 mt-5 form-check">
                                                                <input type="checkbox" class="form-check-input fw-bolder"
                                                                    id="syaratCheckbox" name="setuju_syarat_dan_ketentuan"
                                                                    required>
                                                                <label class="form-check-label" for="syaratCheckbox">Saya
                                                                    Setuju dengan syarat dan ketentuan yang berlaku</label>
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Batal</button>
                                                            <button class="btn btn-kalasewa"
                                                                type="submit">Submit</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- END FORM PEMILIK SEWA -->
                            </div>
                        </div>
                        <!-- END NAVTABS -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('layout.footer')
@endsection
