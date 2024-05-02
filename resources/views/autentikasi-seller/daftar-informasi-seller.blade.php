@extends('layout-seller.layout-seller')
@section('content')
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="mb-3 pb-1">
                <span class="h1 fw-bold mb-0">Mohon isi informasi Anda</span>
            </div>
            <div class="card" style="border-radius: 1rem;">
                <div class="row">

                    <div class="d-md-block align-items-center">
                        <div class="card-body p-4 p-lg-5 text-black">

                            <form action="{{ route('seller.registerInformationAction') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        {{ $errors->first() }}
                                    </div>
                                @endif
                                <h5 class="fw-bold mb-3 pb-3" style="letter-spacing: 1px;">Informasi Akun dan Toko
                                </h5>

                                <div data-mdb-input-init class="form-outline mb-4">
                                    <label class="form-label" for="form2Example17">Nama Lengkap Pribadi</label>
                                    <input type="text" id="form2Example17" class="form-control form-control-lg"
                                        name="nama" required />
                                </div>

                                <div data-mdb-input-init class="form-outline mb-4">
                                    <label class="form-label" for="noTelp">Nomor Telpon Toko</label>
                                    <input type="text" id="noTelp" class="form-control form-control-lg" name="noTelp"
                                        pattern="[0-9]*" minlength="10" maxlength="14" required />
                                </div>

                                <div data-mdb-input-init class="form-outline mb-4">
                                    <label class="form-label" for="form2Example17">Nama Toko</label>
                                    <input type="text" id="form2Example17" class="form-control form-control-lg"
                                        name="namaToko" required />
                                </div>

                                <div data-mdb-input-init class="form-outline mb-4">
                                    <label class="form-label" for="form2Example27">Alamat Toko</label>
                                    <textarea type="text" id="alamat" class="form-control form-control-lg" name="AlamatToko" required></textarea>
                                </div>

                                <div class="form-floating mb-4">
                                    <select class="form-select" id="floatingSelect" name="provinsi"
                                        aria-label="Floating label select example" required>
                                        <option selected> </option>
                                        <option value="Jawa Barat">Jawa Barat</option>
                                    </select>
                                    <label for="floatingSelect">Provinsi</label>
                                </div>

                                <div class="form-floating mb-4">
                                    <select class="form-select" id="floatingSelect" name="kota"
                                        aria-label="Floating label select example" required>
                                        <option selected> </option>
                                        <option value="Kota Bandung">Kota Bandung</option>
                                        <option value="Kabupaten Bandung">Kabupaten Bandung</option>
                                    </select>
                                    <label for="floatingSelect">Kota/Kabupaten</label>
                                </div>

                                <div class="d-grid mb-5">
                                    <div data-mdb-input-init class="form-outline">
                                        <label class="form-label" for="kodePos">Kode Pos</label>
                                        <input type="text" id="kodePos" class="form-control" name="kodePos"
                                            pattern="[0-9]*" minlength="5" maxlength="6" required />
                                    </div>
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
