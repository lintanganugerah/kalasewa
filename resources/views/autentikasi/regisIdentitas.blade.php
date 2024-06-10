@extends('layout-seller.layout-seller')
@section('content')
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="mb-3 pb-1">
                <span class="h1 fw-bold mb-0">Isi Identitas</span>
            </div>
            <div class="card" style="border-radius: 1rem;">
                <div class="row">

                    <div class="d-md-block align-items-center">
                        <div class="card-body p-4 p-lg-5 text-black">

                            <form action="{{ route('seller.identitasAction') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        {{ $errors->first() }}
                                    </div>
                                @endif
                                <h5 class="fw-bold mb-3 pb-3" style="letter-spacing: 1px;">Informasi Identitas Anda
                                </h5>

                                <div data-mdb-input-init class="form-outline mb-4">
                                    <label class="form-label" for="form2Example17">Nama Lengkap Pribadi</label>
                                    <input type="text" id="form2Example17" class="form-control form-control-lg"
                                        value="{{ $nama }}" disabled />
                                    <div id="provinsi" class="form-text">Jika ingin ubah nama pribadi silahkan ke menu
                                        Profil sebelum halaman ini
                                    </div>
                                </div>

                                <div data-mdb-input-init class="form-outline mb-4">
                                    <label class="form-label" for="form2Example17">NIK</label>
                                    <input type="text" id="form2Example17" class="form-control form-control-lg"
                                        name="NIK" required />
                                </div>

                                <div class="d-grid mb-5">
                                    <div class="mb-4">
                                        <label for="formFile" class="form-label">Unggah Identias (KTP/SIM)</label>
                                        <input class="form-control" type="file" id="formFile" name="identitas"
                                            accept=".jpg,.png" required>
                                    </div>
                                </div>

                                <div class="d-grid mb-5">
                                    <button data-mdb-button-init data-mdb-ripple-init
                                        class="btn btn-kalasewa btn-lg btn-block" type="submit">Daftar</button>
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
