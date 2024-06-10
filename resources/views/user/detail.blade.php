@extends('layout.template')
@extends('layout.navbar')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/detail.css') }}" />

    <section>
        <div class="detail-container">
            <div class="container text-center">
                <div class="row align-items-start">
                    <div class="col">
                        @foreach ($fotoproduk->where('id_produk', $produk->id)->take(1) as $foto)
                            <img src="{{ asset($foto->path) }}" class="img-thumbnail" alt="{{ $produk->nama_produk }}">
                        @endforeach
                    </div>

                    <div class="col text-start">
                        <h1><strong>{{ $produk->nama_produk }}</strong></h1>
                        <h3>Rp{{ number_format($produk->harga) }} / 3 Hari</h3>
                        <h6>Brand: {{ $produk->brand }}</h6>
                        <h6>Series: {{ $produk->seriesDetail->series }}</h6>
                        @foreach ($produk->ukuran_produk as $size => $detail)
                            <button type="button" class="btn btn-sm btn-outline-dark" disabled>{{ $size }}</button>
                        @endforeach
                        <button type="button" class="btn btn-sm btn-outline-dark" disabled>Female</button>
                        <h1><strong>DESKRIPSI</strong></h1>
                        <p>{{ $produk->deskripsi_produk }}</p>
                    </div>

                    <div class="col">
                        <div class="card text-center">
                            <div class="card-body">
                                <h5 class="card-title">{{ $toko->nama_toko }}</h5>
                                <p class="card-text">Rating : {{ $toko->rating_toko }}</p>
                                <div class="custom-button d-flex justify-content-evenly">
                                    @if (auth()->check() && auth()->user()->role === 'penyewa')
                                        @if ($produk->isInWishlist())
                                            <form action="{{ route('wishlist.remove', ['id' => $produk->id]) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger btn-block">Hapus Wishlist</button>
                                            </form>
                                        @else
                                            <form action="{{ route('wishlist.add', ['id' => $produk->id]) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger btn-block">Tambah Wishlist</button>
                                            </form>
                                        @endif
                                    @else
                                        <form action="" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-danger btn-block" disabled>Tambah Wishlist</button>
                                        </form>
                                    @endif
                                    <form action="#" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger btn-block" disabled>Rental Sekarang</button>
                                    </form>
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
