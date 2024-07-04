@extends('layout.template')
@extends('layout.navbar')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('css/detail.css') }}" />

<section>

    <style>
        .carousel-item {
            transition-duration: 0.3s !important;
            /* 300 milliseconds */
        }

        .no-underline {
            text-decoration: none;
            /* Remove underline */
            color: inherit;
            /* Inherit the color from the parent element or set it explicitly */
        }
    </style>

    <div class="container mt-2 mb-3">
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
    </div>

    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-3">
                    <div class="carousel-container">
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
                                    <div class="carousel-item-detail carousel-item {{ $index == 0 ? 'active' : '' }}">
                                        <img src="{{ asset($foto->path) }}" class="d-block w-100"
                                            alt="{{ $produk->nama_produk }}">
                                    </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button"
                                data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button"
                                data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                    <div class="carousel-thumbnail">
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
                </div>
                <div class="col-6 text-start">
                    <h1><strong>{{ $produk->nama_produk }}</strong></h1>
                    <h3 style="color: orange;"><strong>Rp{{ number_format($produk->harga, 0, '', '.') }} / 3
                            Hari</strong></h3>
                    <p>Rating:
                        @if($averageRating)
                            {{ number_format($averageRating, 1) }}
                        @else
                            Belum ada rating
                        @endif
                    </p>
                    <h3 class="mt-2"><strong>Keterangan Tambahan</strong></h3>
                    <button type="button" class="btn btn-outline-dark">{{$produk->ukuran_produk}}</button>
                    <button type="button" class="btn btn-outline-dark">{{$produk->grade}}</button>
                    @if ($produk->brand_wig)
                        <button type="button" class="btn btn-outline-dark">Wig Brand: {{$produk->brand_wig}}</button>
                    @endif
                    @if ($produk->keterangan_wig)
                        <button type="button" class="btn btn-outline-dark">Wig Styling: {{$produk->keterangan_wig}}</button>
                    @endif

                    <h3 class="mt-4"><strong>Pilihan Additional</strong></h3>
                    @if ($produk->additional)
                        @foreach (json_decode($produk->additional, true) as $nama => $harga)
                            <button type="button" class="btn btn-outline-dark">{{$nama}}</button>
                        @endforeach
                    @else
                        <p>Maaf, Produk ini tidak memiliki additional</p>
                    @endif
                    <h3 class="mt-4"><strong>Informasi Lengkap</strong></h3>
                    <p>{!! nl2br(e($produk->deskripsi_produk)) !!}</p>


                    <h3 class="mt-4"><strong>Aturan Toko</strong></h3>

                    <table>
                        <tr>
                            <th>Nama Peraturan</th>
                            <th>Deskripsi</th>
                            <th>Denda</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($aturan as $atur)
                                <tr>
                                    <td>{{ $atur->nama }}</td>
                                    <td>{{ $atur->deskripsi }}</td>
                                    @if ($atur->terdapat_denda)
                                        @if ($atur->denda_pasti)
                                            <td data-title="Denda" class="align-middle">
                                                Rp. {{ number_format($atur->denda_pasti, 0, '', '.') }}
                                            </td>
                                        @else
                                            <td data-title="Denda" class="align-middle">
                                                {{ $atur->denda_kondisional }}
                                            </td>
                                        @endif
                                    @else
                                        <td data-title="Denda" class="align-middle">-
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
                <div class="col-3">
                    <div class="card" style="width: 18rem;">
                        <div class="container">
                            <div class="card-body text-center">
                                @if ($produk->toko && $produk->toko->user)
                                    <img class="avatar-img" src="{{ asset($produk->toko->user->foto_profil) }}" alt="User"
                                        style="border-radius: 30px; width: 60px;" />
                                    <a href="{{ route('viewToko', ['id' => $produk->toko->id]) }}" class="no-underline">
                                        <h5 class="card-title text-center"><strong>{{ $produk->toko->nama_toko }}</strong>
                                        </h5>
                                    </a>
                                @endif
                                <div class="container-fluid d-flex justify-content-around">
                                    <i class="ri-star-line">
                                        @if($averageTokoRating)
                                            {{ number_format($averageTokoRating, 1) }}
                                        @else
                                            0
                                        @endif
                                    </i>
                                    @if ($averageTokoRating >= 4)
                                        <span class="badge text-bg-warning">Terpercaya</span>
                                    @elseif ($averageTokoRating < 2.5) <span class="badge text-bg-primary">
                                        Pendatang</span>
                                    @elseif ($averageTokoRating >= 2.5 && $averageTokoRating < 4) <span
                                        class="badge text-bg-secondary">Standar</span>
                                    @endif
                                </div>
                                <p class="card-text text-start mt-2">{!! nl2br(e($produk->toko->bio_toko)) !!}</p>
                                <div class="pilihan-user mt-2">
                                    @if (auth()->check() && auth()->user()->role === 'penyewa')
                                        <form action="{{ route('viewOrder', ['id' => $produk->id])}}">
                                            @csrf
                                            <button type="submit" class="btn btn-danger w-100">Rental
                                                Produk</button>
                                        </form>
                                        @if ($produk->isInWishlist())
                                            <form action="{{ route('wishlist.remove', ['id' => $produk->id]) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-danger w-100">Hapus
                                                    Wishlist</button>
                                            </form>
                                        @else
                                            <form action="{{ route('wishlist.add', ['id' => $produk->id]) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger w-100">Tambah
                                                    Wishlist</button>
                                            </form>
                                        @endif
                                    @else
                                        <div class="col my-2">
                                            <button type="button" class="btn btn-danger w-100" disabled>Rental
                                                Produk</button>
                                        </div>
                                        <div class="col">
                                            <button type="button" class="btn btn-outline-danger w-100" disabled>Tambahkan
                                                Wishlist</button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt-5">
        <div class="container">
            <h1 class="mb-3"><strong>Review Produk</strong></h1>
            <table class="w-100" id="review-table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Komentar</th>
                        <th>Foto</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($review as $rev)
                        <tr>
                            <td>{{ $rev->user->nama }}</td>
                            <td>{{ $rev->komentar }}</td>
                            <td>
                                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal-{{ $loop->index }}">
                                    Lihat Foto Review
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @include('layout.footer')

    @foreach($review as $index => $rev)
        <!-- Modal -->
        <div class="modal fade" id="exampleModal-{{ $index }}" tabindex="-1"
            aria-labelledby="exampleModalLabel-{{ $index }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content text-center">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel-{{ $index }}">Review {{ $rev->user->nama }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @foreach ($rev->foto as $foto)
                            <img class="img-thumbnail img-small" src="{{ asset($foto) }}" alt="Review {{ $rev->user->nama }}">
                        @endforeach
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

</section>

@endsection