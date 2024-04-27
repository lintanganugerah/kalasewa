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
                    <p style="color: hsl(217, 10%, 50.8%)">Daftar dengan email dan no telp toko atau pribadi, lalu
                        lakukan registrasi! Mudah Hanya dengan beberapa langkah saja.
                    </p>
                </div>

                <div class="col-lg-6 mb-5 mb-lg-0">
                    <!-- DAFTAR FORM -->
                    <div class="card">
                        <div class="card-body py-5 px-md-5">
                            <form>
                                <h1 class="mb-5 fw-bold ls-tight">
                                    Daftar
                                </h1>

                                <!-- Email input -->
                                <div data-mdb-input-init class="form-outline mb-4">
                                    <label class="form-label" for="form3Example3">Email address</label>
                                    <input type="email" id="form3Example3" name="emailAdress" class="form-control"
                                        required>
                                </div>

                                <!-- Password input -->
                                <div data-mdb-input-init class="form-outline mb-4">
                                    <label class="form-label" for="form3Example4">Nomor Telpon</label>
                                    <input type="text" id="form3Example4" class="form-control" name="notelp"
                                        minlength="11" maxlength="14" pattern="[0-9]+" title="Nomor Telpon Tidak Valid"
                                        required>
                                </div>

                                <!-- Submit button -->
                                <div class="d-grid mb-5">
                                    <button class="btn btn-kalasewa" type="button">Berikutnya</button>
                                </div>

                                <!-- Register buttons -->
                                <div class="text-center">
                                    <p>Sudah memiliki akun? <a href="#" class="fw-bold text-dark">Klik untuk Login</a>
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