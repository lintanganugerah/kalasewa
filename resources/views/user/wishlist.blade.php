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

        <div class="container">
            <h1>Wishlist Saya</h1>
            <div class="row">
                @foreach ($wishlist as $item)
                    <div class="col-md-4">
                        <a href="{{ route('viewDetail', ['id' => $item->produk->id]) }}" class="card-link">
                            <div class="card custom-card text-bg-dark border-secondary">
                                <div class="image-container">
                                    @foreach ($fotoproduk->where('id_produk', $item->produk->id)->take(1) as $foto)
                                        <img src="{{ asset($foto->path) }}" class="img-thumbnail" alt="{{ $item->produk->nama_produk }}">
                                    @endforeach
                                </div>
                                <div class="card-body">
                                    <div class="d-flex mb-1">
                                        <div class="avatar avatar-card me-2">
                                            @foreach ($toko->where('id', $item->produk->id_toko) as $tk)
                                                @foreach ($user->where('id', $tk->id_user) as $usr)
                                                    <img class="avatar-img" src="{{ asset($usr->foto_profil) }}" alt="User" />
                                                @endforeach
                                            @endforeach
                                        </div>
                                        <div class="fs-08-rem user-card">
                                            @foreach ($toko->where('id', $item->produk->id_toko)->take(1) as $tk)
                                                <div class="fw-bold text-truncate">
                                                    {{ $tk->nama_toko }}
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <h5 class="card-title">{{ $item->produk->nama_produk }}</h5>
                                    <p class="card-text">
                                        {{ $item->produk->harga }} / 3 Hari
                                    </p>
                                    <p class="card-text">{{ $item->produk->brand }}</p>
                                    <p class="card-text">{{ $item->produk->seriesDetail->series }}</p>
                                    @foreach ($item->produk->ukuran_produk as $size => $detail)
                                        <button type="button" class="btn btn-sm btn-outline-light" disabled>
                                            {{ $size }}
                                        </button>
                                    @endforeach
                                    <button type="button" class="btn btn-sm btn-outline-light" disabled>
                                        {{ $item->produk->gender }}
                                    </button>
                                    <form action="{{ route('wishlist.remove', ['id' => $item->produk->id]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm mt-2">Hapus dari Wishlist</button>
                                    </form>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

@include('layout.footer')
@endsection
