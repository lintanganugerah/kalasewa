@extends('layout-seller.layout-seller')
@extends('layout.navbar')
@section('content')
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="mb-3 pb-1">
                <span class="h1 fw-bold mb-0">Informasi Anda</span>
            </div>
            <div class="card" style="border-radius: 1rem;">
                <div class="row">
                    <div class="d-md-block align-items-center">
                        <div class="card-body p-4 p-lg-5 text-black">
                            <form action="{{ route('buyer.updatePassword') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        {{ $errors->first() }}
                                    </div>
                                @endif
                                <h5 class="fw-bold mb-3 pb-3" style="letter-spacing: 1px;">Ubah Password</h5>

                                <div data-mdb-input-init class="form-outline mb-4">
                                    <label class="form-label" for="password">Password Lama</label>
                                    <input type="password" id="password" class="form-control form-control-lg" name="password" required />
                                </div>

                                <div data-mdb-input-init class="form-outline mb-4">
                                    <label class="form-label" for="password">Password Baru</label>
                                    <input type="password" id="newPassword" class="form-control form-control-lg" name="newPassword" minlength="8" required />
                                </div>

                                <div data-mdb-input-init class="form-outline mb-4">
                                    <label class="form-label" for="password">Konfirmasi Password Baru</label>
                                    <input type="password" id="confNewPassword" class="form-control form-control-lg" name="confNewPassword" minlength="8" required />
                                </div>

                                
                                <div class="d-grid mb-5">
                                    <button data-mdb-button-init data-mdb-ripple-init class="btn btn-kalasewa btn-lg btn-block" type="submit">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('seller/inputangka.js') }}"></script>
    </section>
@endsection