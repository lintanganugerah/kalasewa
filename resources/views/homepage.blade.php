@extends('layout.template')
@extends('layout.navbar')

@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/homepage.css') }}" />

    <section>
        <div class="main-container container">
            <div class="row py-5">
                <div class="header">
                    <img src="{{ asset('images/kalasewa.png') }}" alt="kalasewa" class="header-image">
                    <h1>K A L A S E W A</h1>
                    <h4>Wujudkan impian cosplaymu bersama-sama!</h4>
                </div>
            </div>

            @include('layout.searchbar')

            <div class="row-spesial">
                <div class="sidebar">
                    <div class="category-column">
                        <div class="list-group pb-4">
                            <h3>Gender</h3>
                            <a href="{{ route('search', ['gender' => 'Pria']) }}"
                                class="list-group-item list-group-item-action">Pria</a>
                            <a href="{{ route('search', ['gender' => 'Wanita']) }}"
                                class="list-group-item list-group-item-action">Wanita</a>
                        </div>


                        <div class="list-group pb-4">
                            <h3>Size</h3>
                            <a href="{{ route('search', ['ukuran_produk' => 'S']) }}"
                                class="list-group-item list-group-item-action">S</a>
                            <a href="{{ route('search', ['ukuran_produk' => 'M']) }}"
                                class="list-group-item list-group-item-action">M</a>
                            <a href="{{ route('search', ['ukuran_produk' => 'L']) }}"
                                class="list-group-item list-group-item-action">L</a>
                            <a href="{{ route('search', ['ukuran_produk' => 'XL']) }}"
                                class="list-group-item list-group-item-action">XL</a>
                        </div>

                        <div class="list-group pb-4">
                            <h3>Series</h3>
                            @foreach ($series->take(10) as $seriesItem)
                                <a href="{{ route('search', ['series' => $seriesItem->id]) }}"
                                    class="list-group-item list-group-item-action">{{ $seriesItem->series }}</a>
                            @endforeach
                            <a href="{{ route('viewSeries') }}" class="list-group-item list-group-item-action">Lihat
                                Lengkap</a>
                        </div>

                    </div>
                </div>

                <div class="content">
                    <div class="card-column">
                        @foreach ($produk->chunk(4) as $chunk)
                            <div class="row-kartu d-flex">
                                @foreach ($chunk as $prod)
                                    <a href="{{ route('viewDetail', ['id' => $prod->id]) }}" class="card-link">
                                        <div class="card custom-card text-bg-dark border-secondary"
                                            style="width: 250px; height: 450px; margin-right: 5px; margin-bottom: 5px;">
                                            @foreach ($fotoproduk->where('id_produk', $prod->id)->take(1) as $foto)
                                                <img src="{{ asset($foto->path) }}" class="card-img-top img-fluid h-50"
                                                    alt="fotoproduk" style="object-fit: cover;">
                                            @endforeach
                                            <div class=" card-body">
                                                <div class="d-flex mb-1">
                                                    <div class="avatar avatar-card me-2">
                                                        @foreach ($toko->where('id', $prod->id_toko) as $tk)
                                                            @foreach ($user->where('id', $tk->id_user) as $usr)
                                                                <img class="avatar-img"
                                                                    src="{{ asset($usr->foto_profil) }}" alt="User" />
                                                            @endforeach
                                                        @endforeach
                                                    </div>
                                                    <div class="fs-08-rem user-card">
                                                        @foreach ($toko->where('id', $prod->id_toko)->take(1) as $tk)
                                                            <div class="fw-bold text-truncate">
                                                                {{ $tk->nama_toko }}
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <h5 class="card-title">{{ $prod->nama_produk }}</h5>
                                                <p class="card-text">Rp{{ number_format($prod->harga) }} / 3 Hari</p>

                                                <p class="card-text">
                                                    <img src="{{ asset('storage/icon/box-seam.png') }}" alt="box-seam"
                                                        style="width: 1em; height: 1em; vertical-align: middle; fill: white;">
                                                    {{ $prod->brand }}
                                                </p>

                                                <p class="card-text">
                                                    <img src="{{ asset('storage/icon/tv.png') }}" alt="tv"
                                                        style="width: 1em; height: 1em; vertical-align: middle; fill: white;">
                                                    {{ $prod->seriesDetail->series }}
                                                </p>

                                                <button type="button" class="btn btn-sm btn-outline-light" disabled>
                                                    {{ $prod->ukuran_produk }}
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-light" disabled>
                                                    {{ $prod->gender }}
                                                </button>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </section>
    <div style="background-color: white;">
        @include('layout.footer')
    </div>
@endsection
