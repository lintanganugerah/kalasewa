@extends('layout-seller.layout-seller')
@section('content')
    @include('layout-seller.navbar')

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>

    <!-- (Optional) Latest compiled and minified JavaScript translation files -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/i18n/defaults-*.min.js"></script>

    <section style="background-color: #f6f6f6;">
        <div class="px-4 py-5 px-md-5 text-center text-lg-start" style="background-color: hsl(0, 0%, 96%)">
            <div class="container">
                <div class="row gx-lg-5 align-items-center">
                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <h1 class="my-5 display-3 fw-bold ls-tight">
                            Selamat Datang, Penjual!
                        </h1>
                        <p style="color: hsl(217, 10%, 50.8%)">Ayo mulai mengelola toko anda secara mudah dan efisien dengan
                            kalasewa!
                        </p>
                    </div>

                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <div class="card">
                            <div class="card-body py-5 px-md-5">
                                <form action="{{ route('seller.loginAction') }}" method="POST">
                                    <h1 class="mb-5 fw-bold ls-tight">
                                        Login
                                    </h1>
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

                                    <!-- Email input -->
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1" name="email">
                                    </div>

                                    <!-- Password input -->
                                    <div class="mb-3">
                                        <label for="pass" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="pass" name="password"
                                            minlength="8">
                                    </div>

                                    <div class="form-check d-flex justify-content-end mb-4">
                                        <a class="form-check-label text-reset" href="#" for="form2Example33">
                                            Lupa password?
                                        </a>
                                    </div>

                                    <!-- Submit button -->
                                    <div class="d-grid mb-5">
                                        <button class="btn btn-kalasewa" type="submit">Masuk</button>
                                    </div>

                                    <!-- Register buttons -->
                                    <div class="text-center">
                                        <p>Belum memiliki akun? <a href="{{ route('seller.registerView') }}"
                                                class="fw-bold text-dark">Klik untuk daftar</a>
                                        </p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Section>
    <!-- Add Bootstrap JS and jQuery scripts here -->
    @include('layout-seller.footer')
@endsection
