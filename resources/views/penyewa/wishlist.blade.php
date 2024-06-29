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

        @include('layout.searchbar')

        <div class="content">
            <h1 class="text-center">Wishlist</h1>
            <div class="card-column">
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
                @foreach ($wishlist->chunk(4) as $chunk)
                <div class="row-kartu d-flex">
                    @foreach ($chunk as $prod)
                    <a href="{{ route('viewDetail', ['id' => $prod->produk->id]) }}" class="card-link">
                        <div class="card custom-card text-bg-dark border-secondary"
                            style="width: 250px; height: 450px; margin-right: 5px; margin-bottom: 5px;">
                            @foreach ($fotoproduk->where('id_produk', $prod->produk->id)->take(1) as $foto)
                            <img src="{{ asset($foto->path) }}" class="card-img-top img-fluid h-50" alt="fotoproduk"
                                style="object-fit: cover;">
                            @endforeach
                            <div class=" card-body">
                                <div class="d-flex mb-1">
                                    <div class="avatar avatar-card me-2">
                                        @foreach ($toko->where('id', $prod->produk->id_toko) as $tk)
                                        @foreach ($user->where('id', $tk->id_user) as $usr)
                                        <img class="avatar-img" src="{{ asset($usr->foto_profil) }}" alt="User" />
                                        @endforeach
                                        @endforeach
                                    </div>
                                    <div class="fs-08-rem user-card">
                                        @foreach ($toko->where('id', $prod->produk->id_toko)->take(1) as $tk)
                                        <div class="fw-bold text-truncate">
                                            {{ $tk->nama_toko }}
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <h5 class="card-title">{{ $prod->produk->nama_produk }}</h5>
                                <p class="card-text">Rp{{ number_format($prod->produk->harga) }} / 3 Hari
                                </p>
                                <p class="card-text">
                                    <img src="{{ asset('storage/icon/box-seam.png') }}" alt="box-seam"
                                        style="width: 1em; height: 1em; vertical-align: middle; fill: white;">
                                    {{ $prod->produk->brand }}
                                </p>
                                <p class="card-text">
                                    <img src="{{ asset('storage/icon/tv.png') }}" alt="tv"
                                        style="width: 1em; height: 1em; vertical-align: middle; fill: white;">
                                    {{ $prod->produk->seriesDetail->series }}
                                </p>
                                <button type="button" class="btn btn-sm btn-outline-light" disabled>
                                    {{ $prod->produk->ukuran_produk }}
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-light" disabled>
                                    {{ $prod->produk->gender }}
                                </button>
                                <form action="{{ route('wishlist.remove', ['id' => $prod->produk->id]) }}"
                                    method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm mt-2">Hapus dari
                                        Wishlist</button>
                                </form>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
                @endforeach
            </div>
        </div>


    </div>
</section>

@include('layout.footer')
@endsection