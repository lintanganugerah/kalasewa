@extends('layout-seller.layout-seller')
@section('content')
@include('layout-seller.navbar')

<section style="background-color: #f6f6f6;">
    <div class="px-4 py-5 px-md-5 text-center text-lg-start" style="background-color: hsl(0, 0%, 96%)">
        <div class="container">
            <div class="row gx-lg-5 align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <h1 class="my-5 display-3 fw-bold ls-tight">
                        Lakukan Verifikasi Kode
                    </h1>
                    <p style="color: hsl(217, 10%, 50.8%)">Mohon cek email yang anda berikan sebelumnya
                    </p>
                </div>

                <div class="col-lg-6 mb-5 mb-lg-0">
                    <!-- Verifikasi FORM -->
                    <div class="card">
                        <div class="card-body py-5 px-md-5">
                            <form>
                                <h1 class="mb-3 fw-bold ls-tight">
                                    Verifikasi
                                </h1>
                                <h4 class="mb-5 ls-tight">
                                    Kode verifikasi telah dikirimkan ke email anda di [[emailSeller@gmail.com]]
                                </h4>

                                <!-- Email input -->
                                <div data-mdb-input-init class="form-outline mb-4">
                                    <label class="form-label" for="form3Example3">Kode verifikasi</label>
                                    <input type="text" minlength="8" maxlength="14" class="form-control" name="kode"
                                        required>
                                </div>

                                <!-- Submit button -->
                                <div class="d-grid mb-5">
                                    <button class="btn btn-kalasewa" type="button">Berikutnya</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- END Verifikasi FORM -->
                </div>
            </div>
        </div>
    </div>
</Section>
<!-- Add Bootstrap JS and jQuery scripts here -->
@include('layout-seller.footer')
@endsection