@extends('layout.template')
@extends('layout.navbar')

@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('css/searchbar.css') }}" />
<section>

    <div class="header-title">
        <div class="container-fluid mt-5">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <h1><strong>Cari toko favoritmu!</strong></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="filter-select">
        <div class="container-fluid">
            <div class="container">
                <div class="form-filter">
                    <form action="{{ route('searchToko') }}" method="GET" class="">
                        @csrf
                        <div class="searchbar my-3">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control form-search custom-search-bar"
                                    placeholder="Toko mana yang akan dikunjungi hari ini?" aria-label="Search" />
                                <button class="btn py-2 custom-search-button" type="submit" id="search-button">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="container">
            @foreach ($toko->chunk(5) as $chunk)
            <div class="row-kartu d-flex mb-3">
                @foreach ($chunk as $tk)
                <div class="col-2" style="margin-right: 43px;">
                    <a href="{{ route('viewToko', ['id' => $tk->id]) }}" class="card-link">
                        <div class="card custom-card text-bg-dark border-secondary" style="width: 250px; height: 100%;">
                            <img src="{{ asset($tk->user->foto_profil) }}" class="card-img-top img-fluid h-100"
                                alt="fotoproduk" style="object-fit: cover;">
                            <div class="card-body">
                                <h5 style="margin-bottom: 5px;"><strong>{{ $tk->nama_toko }}</strong></h5>
                                <div class="rating-toko" style="margin-bottom: 5px;">
                                    Rating Toko : {{ $tk->rating_toko }} <i class="ri-star-line"></i>
                                </div>
                                @if ($tk->rating_toko >= 4)
                                <h5><span class="badge text-bg-warning">Terpercaya</span></h5>
                                @elseif ($tk->rating_toko < 2.5) <h5>
                                    <span class="badge text-bg-primary">
                                        Pendatang</span>
                                    </h5>
                                    @elseif ($tk->rating_toko >= 2.5 && $tk->rating_toko < 4) <h5><span
                                            class="badge text-bg-secondary">Standar</span></h5>
                                        @endif
                                        <p class="card-text" style="color: orange;">
                                            <i class="ri-t-shirt-line"></i>
                                            {{ $tk->produks_count }} Kostum
                                        </p>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
            @endforeach
        </div>
    </div>

    @include('layout.footer')

</section>

@endsection