@extends('layout.template')
@extends('layout.navbar')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/detail.css') }}" />

    <section>
        <div class="detail-container">
            <div class="container text-center">
                <div class="row align-items-start">

                    <div class="col">
                        <div id="carouselExampleIndicators" class="carousel slide">
                            <div class="carousel-indicators">
                                @foreach ($fotoproduk->where('id_produk', $produk->id) as $index => $foto)
                                    <button type="button" data-bs-target="#carouselExampleIndicators"
                                        data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}"
                                        aria-current="{{ $index == 0 ? 'true' : 'false' }}"
                                        aria-label="Slide {{ $index + 1 }}"></button>
                                @endforeach
                            </div>
                            <div class="carousel-inner">
                                @foreach ($fotoproduk->where('id_produk', $produk->id) as $index => $foto)
                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                        <img src="{{ asset($foto->path) }}" class="d-block w-100"
                                            alt="{{ $produk->nama_produk }}">
                                    </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>

                        <!-- Thumbnails -->
                        <div class="row mt-3">
                            <div class="d-flex flex-wrap">
                                @foreach ($fotoproduk->where('id_produk', $produk->id) as $index => $foto)
                                    <div class="p-1">
                                        <div class="thumbnail-container" data-bs-target="#carouselExampleIndicators"
                                            data-bs-slide-to="{{ $index }}">
                                            <img src="{{ asset($foto->path) }}" class="img-thumbnail thumbnail-image"
                                                alt="{{ $produk->nama_produk }}">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>


                    <div class="col text-start">
                        <h1><strong>{{ $produk->nama_produk }}</strong></h1>
                        <h3>Rp{{ number_format($produk->harga, 0, '', '.') }} / 3 Hari</h3>
                        <h6>Brand: {{ $produk->brand }}</h6>
                        <h6>Series: {{ $produk->seriesDetail->series }}</h6>
                        <button type="button" class="btn btn-sm btn-outline-dark"
                            disabled>{{ $produk->ukuran_produk }}</button>
                        <button type="button" class="btn btn-sm btn-outline-dark" disabled>{{ $produk->gender }}</button>
                        <h1 style="margin-top: 5px;"><strong>ADDITIONAL</strong></h1>
                        @foreach (json_decode($produk->additional) as $additional => $detail)
                            <button type="button" class="btn btn btn-outline-dark">{{ $additional }}</button>
                        @endforeach
                        <h1 style="margin-top: 20px;"><strong>DESKRIPSI</strong></h1>
                        <p>{!! nl2br(e($produk->deskripsi_produk)) !!}</p>
                    </div>

                    <div class="col">
                        <div class="card text-center">
                            <div class="card-body">
                                @if ($produk->toko && $produk->toko->user)
                                    <!-- Tampilkan foto profil -->
                                    <img class="avatar-img" src="{{ asset($produk->toko->user->foto_profil) }}"
                                        alt="User" />
                                    <!-- Tampilkan nama toko -->
                                    <h5 class="col">{{ $produk->toko->nama_toko }}</h5>
                                @endif
                                <p class="card-text">
                                    <img src=" {{ asset('storage/icon/star.svg') }}" alt="star">
                                    : {{ $produk->toko->rating_toko }}
                                </p>
                                <p class="card-text">
                                    <img src="{{ asset('storage/icon/award.svg') }}" alt="award">
                                    : {{ $produk->toko->user->badge }}
                                </p>
                                <p class="card-text">{!! nl2br(e($produk->toko->bio_toko)) !!}</p>
                                <a href="{{ $produk->toko->user->link_sosial_media }}"><img
                                        src=" {{ asset('storage/icon/instagram.svg') }}" alt="Instagram"></a>
                                @csrf
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                <div class="custom-button d-flex justify-content-evenly">

                                    <!-- Cek Apakah Sudah Login -->
                                    @if (auth()->check() && auth()->user()->role === 'penyewa')
                                        <!-- Cek Apakah Sudah ada Di Wishlist -->
                                        @if ($produk->isInWishlist())
                                            <form action="{{ route('wishlist.remove', ['id' => $produk->id]) }}"
                                                method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger btn-block">Hapus
                                                    Wishlist</button>
                                            </form>
                                        @else
                                            <form action="{{ route('wishlist.add', ['id' => $produk->id]) }}"
                                                method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger btn-block">Tambah
                                                    Wishlist</button>
                                            </form>
                                        @endif
                                        <form action="#" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-danger btn-block">Rental
                                                Sekarang</button>
                                        </form>
                                    @else
                                        <form action="" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-danger btn-block" disabled>Tambah
                                                Wishlist</button>
                                        </form>
                                        <form action="#" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-danger btn-block" disabled>Rental
                                                Sekarang</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    @include('layout.footer')
@endsection
