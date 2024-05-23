@extends('layout-seller.layout-seller')
@section('content')
    @include('layout-seller.navbar')

    <section style="background-color: #f6f6f6;">
        <div class="px-4 py-5 px-md-5 text-center text-lg-start" style="background-color: hsl(0, 0%, 96%)">
            <div class="container">
                <div class="row gx-lg-5 align-items-center">
                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <h1 class="my-5 display-3 fw-bold ls-tight">
                            Mari bergabung di Kalasewa!
                        </h1>
                        <p style="color: hsl(217, 10%, 50.8%)">Daftar dengan email pribadi, lalu
                            lakukan registrasi! Mudah hanya dengan beberapa langkah saja.
                        </p>
                    </div>

                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <!-- NAVTABS -->
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="pemilik-sewa-tab" href="{{ route('seller.registerView') }}"
                                        role="tab" aria-controls="pemilik-sewa" aria-selected="true">Pemilik Sewa</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="penyewa-tab"
                                        href="{{ route('buyer.registerViewBuyer') }}" role="tab" aria-controls="penyewa"
                                        aria-selected="false">Penyewa</a>
                                </li>
                            </ul>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane show active" id="penyewa" role="tabpanel" aria-labelledby="penyewa-tab">
                                <!-- FORM PENYEWA -->
                                <div class="card">
                                    <div class="card-body py-5 px-md-5">
                                        <h3 class="mb-5 fw-bold ls-tight">
                                            Daftar Sebagai Penyewa
                                        </h3>
                                        <form id="formRegister" action="{{ route('buyer.registerAction') }}" method="POST">
                                            @csrf
                                            @if (session('error'))
                                                <div class="alert alert-danger">
                                                    {{ session('error') }}
                                                </div>
                                            @endif
                                            <!-- Form -->
                                            <div data-mdb-input-init class="form-outline mb-4">
                                                <label class="form-label" for="formPenyewaEmail">Email address</label>
                                                <input type="email" id="formPenyewaEmail" name="email"
                                                    class="form-control" required>
                                            </div>

                                            <!-- Submit -->
                                            <div class="d-grid mb-5">
                                                <button type="button" class="btn btn-kalasewa"
                                                    onclick="showModal()">Daftar</button>
                                            </div>

                                            <!-- Login -->
                                            <div class="text-center">
                                                <p>Sudah memiliki akun? <a href="{{ route('seller.loginView') }}"
                                                        class="fw-bold text-dark">Klik untuk Login</a></p>
                                            </div>

                                            <div class="modal fade" id="syaratdanKetentuan" tabindex="-1"
                                                aria-labelledby="syaratdanKetentuanLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="syaratdanKetentuanlLabel">Harap baca
                                                                syarat dan Ketentuan berikut!</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            { ISI SYARAT DAN KETENTUAN NANTI NYA }
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-kalasewa" type="submit">Saya Setuju
                                                                dengan Syarat dan Ketentuan yang berlaku</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- END FORM PENYEWA -->
                            </div>
                        </div>
                    </div>
                    <!-- END NAVTABS -->
                </div>
            </div>
        </div>
    </section>
    <script>
        function showModal() {
            var myModal = new bootstrap.Modal(document.getElementById('syaratdanKetentuan'), {
                keyboard: false
            });
            myModal.show();
        }
    </script>
    @include('layout-seller.footer')
@endsection
