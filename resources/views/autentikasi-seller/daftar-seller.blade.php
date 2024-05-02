@extends('layout-seller.layout-seller')
@section('content')
    @include('layout-seller.navbar')

    <section style="background-color: #f6f6f6;">
        <div class="px-4 py-5 px-md-5 text-center text-lg-start" style="background-color: hsl(0, 0%, 96%)">
            <div class="container">
                <div class="row gx-lg-5 align-items-center">
                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <h1 class="my-5 display-3 fw-bold ls-tight">
                            Mari mulai berjualan di Kalasewa!
                        </h1>
                        <p style="color: hsl(217, 10%, 50.8%)">Daftar dengan email toko atau pribadi, lalu
                            lakukan registrasi! Mudah Hanya dengan beberapa langkah saja.
                        </p>
                    </div>

                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <!-- DAFTAR FORM -->
                        <div class="card">
                            <div class="card-body py-5 px-md-5">
                                <h3 class="mb-5 fw-bold ls-tight">
                                    Daftar Sebagai Penjual (Pemilik Sewa)
                                </h3>
                                <form action="{{ route('seller.registerAction') }}" method="POST">
                                    @csrf
                                    @if (session('error'))
                                        <div class="alert alert-danger">
                                            {{ session('error') }}
                                        </div>
                                    @endif
                                    <!-- Email input -->
                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <label class="form-label" for="form3Example3">Email address</label>
                                        <input type="email" id="form3Example3" name="email" class="form-control"
                                            required>
                                    </div>

                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <label class="form-label" for="form3Example3">Password</label>
                                        <input type="password" id="form3Example3" name="password" class="form-control"
                                            required>
                                    </div>

                                    <!-- Submit button -->
                                    <div class="d-grid mb-5">
                                        <button class="btn btn-kalasewa" type="submit">Daftar</button>
                                    </div>

                                    <!-- Register buttons -->
                                    <div class="text-center">
                                        <p>Sudah memiliki akun? <a href="{{ route('seller.loginView') }}"
                                                class="fw-bold text-dark">Klik untuk
                                                Login</a>
                                        </p>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- END DAFTAR FORM -->
                    </div>
                </div>
            </div>
        </div>
    </Section>
    <!-- Add Bootstrap JS and jQuery scripts here -->
    @include('layout-seller.footer')
@endsection
