@extends('layout.template')
@extends('layout.navbar')

@section('content')

<link rel="stylesheet" type="text/css" href="{{ asset('css/detail.css') }}">

<div class="detail-container">
    <div class="row">
        <div class="catalog-item catalog-image">

            <div id="carouselExampleIndicators" class="carousel slide">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                    <img src="{{ asset('images/catalogue.jpg') }}" class="d-block w-100" alt="Catalog_Photo">
                    </div>
                    <div class="carousel-item">
                    <img src="{{ asset('images/catalogue.jpg') }}" class="d-block w-100" alt="Catalog_Photo">
                    </div>
                    <div class="carousel-item">
                    <img src="{{ asset('images/catalogue.jpg') }}" class="d-block w-100" alt="Catalog_Photo">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            
        </div>
        <div class="catalog-item catalog-description">
            <div class="description">
                <h1>NAMA KATALOG</h1>
                <h3>Rp100.000 / 3 Hari</h3>
                <h6>Brand A</h6>
                <h6>Sereis B</h6>
                <h6>Karakter C</h6>
                <button type="button" class="btn btn-sm btn-outline-light">M</button>
                <button type="button" class="btn btn-sm btn-outline-light">Female</button>
                <h1>INFORMASI LENGKAP</h1>
                <h6>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam id tristique sem, nec sollicitudin tortor. Sed in suscipit sem. Vestibulum dapibus eget lectus eu consectetur. Nulla commodo condimentum lorem, id egestas magna pellentesque et. Curabitur velit dolor, condimentum eget pulvinar non, tempus eget lacus. Mauris cursus feugiat suscipit. Etiam nisi tellus, lacinia sit amet tempus eu, convallis sed dolor. Morbi in maximus tellus.

Donec id ipsum viverra, fringilla lorem in, pretium ipsum. Maecenas bibendum lacus sed massa iaculis, eget commodo mi sodales. Nulla nec diam ac est consequat tempus. Proin ac posuere metus. Donec a fringilla lectus, eu pulvinar risus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla posuere venenatis orci, in pretium magna sollicitudin vel. Nulla in nisl eget massa rhoncus bibendum ut id tortor. Nulla ipsum ante, congue sed iaculis id, finibus ultricies nisl.</h6>
            </div>
        </div>
        <div class="catalog-item catalog-choice">
            <h1>CATALOG CHOICE</h1>
        </div>
    </div>
    <div class="row">
        <div class="footer">
            <h6>All right reserved by Kalasewa © 2024.</h6>
        </div>
    </div>
</div>

@endsection
