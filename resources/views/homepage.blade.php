@extends('layout.template')
@extends('layout.navbar')

@section('content')

<div class="main-container">
    <div class="row">
        <div class="header">
            <h1>K A L A S E W A</h1>
            <h4>Wujudkan impian cosplaymu bersama-sama!</h4>
        </div>
    </div>
    <div class="row">
        <div class="carousel">

            <!-- CAROUSEL -->
            <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('images/carousel1.jpg') }}" class="d-block w-100 carousel-image" alt="carousel1">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/carousel2.jpg') }}" class="d-block w-100 carousel-image" alt="carousel2">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/carousel3.jpg') }}" class="d-block w-100 carousel-image" alt="carousel3">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            
        </div>
    </div>

    <div class="row">
        <div class="searchbar">
            <div class="input-group">
                <form action="#" method="post" class="d-flex w-100">
                    @csrf
                    <input type="text" name="search" class="form-control form-search custom-search-bar" placeholder="Mau cosplay apa hari ini?" aria-label="Search">
                    <button class="btn btn-primary py-2 custom-search-button" type="submit" id="search-button">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="sidebar">

        <div class="category-column">
            <div class="list-group pb-4">
                <h3>Gender</h3>
                <a href="#" class="list-group-item list-group-item-action border-secondary">Male</a>
                <a href="#" class="list-group-item list-group-item-action border-secondary">Female</a>
            </div>

            <div class="list-group pb-4">
                <h3>Size</h3>
                <a href="#" class="list-group-item list-group-item-action border-secondary">S</a>
                <a href="#" class="list-group-item list-group-item-action border-secondary">M</a>
                <a href="#" class="list-group-item list-group-item-action border-secondary">L</a>
                <a href="#" class="list-group-item list-group-item-action border-secondary">XL</a>
            </div>

            <div class="list-group pb-4">
                <h3>Series</h3>
                <a href="#" class="list-group-item list-group-item-action border-secondary">Series 1</a>
                <a href="#" class="list-group-item list-group-item-action border-secondary">Series 2</a>
                <a href="#" class="list-group-item list-group-item-action border-secondary">Series 3</a>
            </div>

            <div class="list-group pb-4">
                <h3>Brand</h3>
                <a href="#" class="list-group-item list-group-item-action border-secondary">Brand 1</a>
                <a href="#" class="list-group-item list-group-item-action border-secondary">Brand 2</a>
                <a href="#" class="list-group-item list-group-item-action border-secondary">Brand 3</a>
            </div>
            
        </div>
            

        </div>
        <div class="content">
            <div class="card-column">

                <!-- Row 1 -->
                <div class="card-row">
                    <div class="row justify-content-center">
                        <div class="col-md-3 d-flex">
                            <a href="#" class="card-link">
                                <div class="card custom-card text-bg-dark border-secondary">
                                    <img src="{{ asset('images/catalogue.jpg') }}" class="card-img-top" alt="">
                                    <div class="card-body">
                                        <div class="d-flex mb-1">
                                            <div class="avatar avatar-card me-2">
                                            <img class="avatar-img" src="{{ asset('images/profile.png') }}" alt="User">
                                            </div>
                                            <div class="fs-08-rem user-card">
                                            <div class="fw-bold text-truncate">Nama Toko</div>
                                            </div>
                                        </div>
                                        <h5 class="card-title">NAMA KATALOG</h5>
                                        <p class="card-text">Rp100.000 / 3 Hari</p>
                                        <p class="card-text">Brand A</p>
                                        <p class="card-text">Series B</p>
                                        <p class="card-text">Karakter C</p>
                                        <button type="button" class="btn btn-sm btn-outline-light">M</button>
                                        <button type="button" class="btn btn-sm btn-outline-light">Female</button>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 d-flex">
                            <a href="#" class="card-link">
                                <div class="card custom-card text-bg-dark border-secondary">
                                    <img src="{{ asset('images/catalogue.jpg') }}" class="card-img-top" alt="">
                                    <div class="card-body">
                                        <div class="d-flex mb-1">
                                            <div class="avatar avatar-card me-2">
                                            <img class="avatar-img" src="{{ asset('images/profile.png') }}" alt="User">
                                            </div>
                                            <div class="fs-08-rem user-card">
                                            <div class="fw-bold text-truncate">Nama Toko</div>
                                            </div>
                                        </div>
                                        <h5 class="card-title">NAMA KATALOG</h5>
                                        <p class="card-text">Rp100.000 / 3 Hari</p>
                                        <p class="card-text">Brand A</p>
                                        <p class="card-text">Series B</p>
                                        <p class="card-text">Karakter C</p>
                                        <button type="button" class="btn btn-sm btn-outline-light">M</button>
                                        <button type="button" class="btn btn-sm btn-outline-light">Female</button>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 d-flex">
                            <a href="#" class="card-link">
                                <div class="card custom-card text-bg-dark border-secondary">
                                    <img src="{{ asset('images/catalogue.jpg') }}" class="card-img-top" alt="">
                                    <div class="card-body">
                                        <div class="d-flex mb-1">
                                            <div class="avatar avatar-card me-2">
                                            <img class="avatar-img" src="{{ asset('images/profile.png') }}" alt="User">
                                            </div>
                                            <div class="fs-08-rem user-card">
                                            <div class="fw-bold text-truncate">Nama Toko</div>
                                            </div>
                                        </div>
                                        <h5 class="card-title">NAMA KATALOG</h5>
                                        <p class="card-text">Rp100.000 / 3 Hari</p>
                                        <p class="card-text">Brand A</p>
                                        <p class="card-text">Series B</p>
                                        <p class="card-text">Karakter C</p>
                                        <button type="button" class="btn btn-sm btn-outline-light">M</button>
                                        <button type="button" class="btn btn-sm btn-outline-light">Female</button>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 d-flex">
                            <a href="#" class="card-link">
                                <div class="card custom-card text-bg-dark border-secondary">
                                    <img src="{{ asset('images/catalogue.jpg') }}" class="card-img-top" alt="">
                                    <div class="card-body">
                                        <div class="d-flex mb-1">
                                            <div class="avatar avatar-card me-2">
                                            <img class="avatar-img" src="{{ asset('images/profile.png') }}" alt="User">
                                            </div>
                                            <div class="fs-08-rem user-card">
                                            <div class="fw-bold text-truncate">Nama Toko</div>
                                            </div>
                                        </div>
                                        <h5 class="card-title">NAMA KATALOG</h5>
                                        <p class="card-text">Rp100.000 / 3 Hari</p>
                                        <p class="card-text">Brand A</p>
                                        <p class="card-text">Series B</p>
                                        <p class="card-text">Karakter C</p>
                                        <button type="button" class="btn btn-sm btn-outline-light">M</button>
                                        <button type="button" class="btn btn-sm btn-outline-light">Female</button>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Row 2 -->
                <div class="card-row">
                    <div class="row justify-content-center">
                    <div class="col-md-3 d-flex">
                            <a href="#" class="card-link">
                                <div class="card custom-card text-bg-dark border-secondary">
                                    <img src="{{ asset('images/catalogue.jpg') }}" class="card-img-top" alt="">
                                    <div class="card-body">
                                        <div class="d-flex mb-1">
                                            <div class="avatar avatar-card me-2">
                                            <img class="avatar-img" src="{{ asset('images/profile.png') }}" alt="User">
                                            </div>
                                            <div class="fs-08-rem user-card">
                                            <div class="fw-bold text-truncate">Nama Toko</div>
                                            </div>
                                        </div>
                                        <h5 class="card-title">NAMA KATALOG</h5>
                                        <p class="card-text">Rp100.000 / 3 Hari</p>
                                        <p class="card-text">Brand A</p>
                                        <p class="card-text">Series B</p>
                                        <p class="card-text">Karakter C</p>
                                        <button type="button" class="btn btn-sm btn-outline-light">M</button>
                                        <button type="button" class="btn btn-sm btn-outline-light">Female</button>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 d-flex">
                            <a href="#" class="card-link">
                                <div class="card custom-card text-bg-dark border-secondary">
                                    <img src="{{ asset('images/catalogue.jpg') }}" class="card-img-top" alt="">
                                    <div class="card-body">
                                        <div class="d-flex mb-1">
                                            <div class="avatar avatar-card me-2">
                                            <img class="avatar-img" src="{{ asset('images/profile.png') }}" alt="User">
                                            </div>
                                            <div class="fs-08-rem user-card">
                                            <div class="fw-bold text-truncate">Nama Toko</div>
                                            </div>
                                        </div>
                                        <h5 class="card-title">NAMA KATALOG</h5>
                                        <p class="card-text">Rp100.000 / 3 Hari</p>
                                        <p class="card-text">Brand A</p>
                                        <p class="card-text">Series B</p>
                                        <p class="card-text">Karakter C</p>
                                        <button type="button" class="btn btn-sm btn-outline-light">M</button>
                                        <button type="button" class="btn btn-sm btn-outline-light">Female</button>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 d-flex">
                            <a href="#" class="card-link">
                                <div class="card custom-card text-bg-dark border-secondary">
                                    <img src="{{ asset('images/catalogue.jpg') }}" class="card-img-top" alt="">
                                    <div class="card-body">
                                        <div class="d-flex mb-1">
                                            <div class="avatar avatar-card me-2">
                                            <img class="avatar-img" src="{{ asset('images/profile.png') }}" alt="User">
                                            </div>
                                            <div class="fs-08-rem user-card">
                                            <div class="fw-bold text-truncate">Nama Toko</div>
                                            </div>
                                        </div>
                                        <h5 class="card-title">NAMA KATALOG</h5>
                                        <p class="card-text">Rp100.000 / 3 Hari</p>
                                        <p class="card-text">Brand A</p>
                                        <p class="card-text">Series B</p>
                                        <p class="card-text">Karakter C</p>
                                        <button type="button" class="btn btn-sm btn-outline-light">M</button>
                                        <button type="button" class="btn btn-sm btn-outline-light">Female</button>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 d-flex">
                            <a href="#" class="card-link">
                                <div class="card custom-card text-bg-dark border-secondary">
                                    <img src="{{ asset('images/catalogue.jpg') }}" class="card-img-top" alt="">
                                    <div class="card-body">
                                        <div class="d-flex mb-1">
                                            <div class="avatar avatar-card me-2">
                                            <img class="avatar-img" src="{{ asset('images/profile.png') }}" alt="User">
                                            </div>
                                            <div class="fs-08-rem user-card">
                                            <div class="fw-bold text-truncate">Nama Toko</div>
                                            </div>
                                        </div>
                                        <h5 class="card-title">NAMA KATALOG</h5>
                                        <p class="card-text">Rp100.000 / 3 Hari</p>
                                        <p class="card-text">Brand A</p>
                                        <p class="card-text">Series B</p>
                                        <p class="card-text">Karakter C</p>
                                        <button type="button" class="btn btn-sm btn-outline-light">M</button>
                                        <button type="button" class="btn btn-sm btn-outline-light">Female</button>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="footer">
            <h6>All right reserved by Kalasewa © 2024.</h6>
        </div>
    </div>
</div>

@endsection
