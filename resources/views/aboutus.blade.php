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

        <h1 class="text-start">TENTANG KALASEWA</h1>

        <p class="mb-3">{!! nl2br(e("Selamat datang di Kalasewa, platform yang menghubungkan para penggemar cosplay
            dengan pemilik kostum cosplay di kota Bandung!

            Kalasewa didirikan dengan visi untuk memudahkan akses ke kostum cosplay bagi para cosplayer dari berbagai
            latar belakang. Kami menyadari bahwa memiliki kostum cosplay bisa menjadi investasi yang besar, baik dari
            segi waktu maupun biaya. Oleh karena itu, kami hadir untuk menyediakan solusi praktis bagi para cosplayer
            yang ingin menyewa kostum tanpa harus membeli dan merawatnya sendiri.

            Kalasewa berperan sebagai penyedia layanan yang menghubungkan pemilik sewa dan penyewa yang ingin menyewa
            kostum cosplay. Kami menyediakan platform yang aman dan nyaman bagi kedua belah pihak untuk berinteraksi dan
            bertransaksi. Dengan fitur verifikasi identitas, sistem penilaian kepercayaan, dan mekanisme penyelesaian
            masalah yang adil, kami berusaha memastikan pengalaman sewa yang menyenangkan dan bebas dari masalah.
            ")) !!}
        </p>
    </div>
</section>

@include('layout.footer')
@endsection