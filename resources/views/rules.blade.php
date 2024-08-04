@extends('layout.template')
@extends('layout.navbar')

@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/wishlist.css') }}" />

    <section>
        <div class="main-container container">
            <div class="row py-5">
                <div class="header">
                    <img src="{{ asset('images/kalasewa.png') }}" alt="kalasewa" class="header-image">
                    <h1 class="mt-3">K A L A S E W A</h1>
                    <h4 class="mb-4">Wujudkan impian cosplaymu bersama-sama!</h4>
                </div>
            </div>

            <h2 class="text-center mb-5">ATURAN KALASEWA</h2>

            <div class="row justify-content-center">
                @foreach ($peraturans as $peraturan)
                    <div class="col-md-8 mb-4">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <h4 class="card-title"><strong>{{ $peraturan->Judul }}</strong></h4>
                                <p class="card-text">{!! nl2br(e($peraturan->Peraturan)) !!}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

    @include('layout.footer')
@endsection
