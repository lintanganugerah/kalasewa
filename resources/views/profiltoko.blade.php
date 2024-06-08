@extends('layout-seller.selllayout')
@section('content')
    <div class="row">
        <div class="col">
            <div class="text-left mb-5 mt-3">
                <h1 class="fw-bold text-secondary">Profil Toko</h1>
                <h4 class="fw-semibold text-secondary">Atur Profil Toko Anda</h4>
            </div>

            <div class="row gx-5">

                <div class="card">
                    <div class="card-header">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="profil-tab" data-bs-toggle="tab"
                                    data-bs-target="#profil" type="button" role="tab" aria-controls="profil"
                                    aria-selected="true">Profil</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="penilaian-tab" onclick="window.location.href='#'"
                                    type="button" role="tab" aria-controls="penilaian"
                                    aria-selected="false">Penilaian</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="contact-tab" onclick="window.location.href='#'" type="button"
                                    role="tab" aria-controls="contact" aria-selected="false">Peraturan Sewa Toko
                                    Anda</button>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="profil" role="tabpanel"
                                aria-labelledby="profil-tab">
                                <h5 class="card-title">Profil</h5>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        {{ $errors->first() }}
                                    </div>
                                @endif
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <form action="{{ route('seller.profilTokoAction') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="userPhoto" class="form-label">Foto Profil</label>
                                        <div class="d-flex align-items-start">
                                            <div id="userPhotoContainer" class="me-3">
                                                <img id="userPhotoPreview" src="{{ asset(session('profilpath')) }}"
                                                    style="width:150px; height:150px; object-fit: cover;" alt="User Photo"
                                                    class="img-thumbnail">
                                            </div>
                                            <div class="flex-grow-1">
                                                <small class="form-text text-muted">
                                                    <ul>
                                                        <li>Disarankan Rasio foto 1:1</li>
                                                        <li>Ukuran max 5MB</li>
                                                        <li>JPG, JPEG, PNG</li>
                                                    </ul>
                                                </small>
                                                <input type="file" name="foto" class="form-control mb-2"
                                                    id="userPhoto" accept=".jpg,.png">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Nama Lengkap
                                            Pribadi</label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1"
                                            value="{{ $user->nama }}" name="nama" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Nama Toko</label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1"
                                            value="{{ session('namatoko') }}" name="namaToko" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Nomor Telpon</label>
                                        <input type="text" class="form-control" id="noTelp"
                                            value="{{ $user->no_telp }}" name="noTelp"minlength="10" maxlength="14"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Alamat Toko</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="AlamatToko" required>asdas</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <div data-mdb-input-init class="form-outline">
                                            <label class="form-label" for="kodePos">Kode Pos</label>
                                            <input type="text" id="kodePos" class="form-control" name="kodePos"
                                                pattern="[0-9]*" minlength="5" maxlength="6"
                                                value="{{ $user->kode_pos }}" required />
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="floatingSelect" name="kota"
                                            aria-label="Floating label select example" required>
                                            <option value="Kota Bandung"
                                                {{ $user->kota == 'Kota Bandung' ? 'selected' : '' }}>Kota Bandung</option>
                                            <option value="Kabupaten Bandung"
                                                {{ $user->kota == 'Kabupaten Bandung' ? 'selected' : '' }}>Kabupaten
                                                Bandung
                                            </option>
                                        </select>
                                        <label for="floatingSelect">Kota/Kabupaten</label>
                                    </div>

                                    <div class="mb-5">
                                        <label class="form-label">Metode Pengiriman</label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="grab"
                                                value="Grab" name="metode_kirim[]"
                                                {{ in_array('Grab', $decodeKirim) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="grab">Grab</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="goSend"
                                                value="GoSend" name="metode_kirim[]"
                                                {{ in_array('GoSend', $decodeKirim) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="goSend">GoSend</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="jne"
                                                value="JNE" name="metode_kirim[]"
                                                {{ in_array('JNE', $decodeKirim) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="jne">JNE</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="jnt"
                                                value="JNT" name="metode_kirim[]"
                                                {{ in_array('JNT', $decodeKirim) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="jnt">JNT</label>
                                        </div>
                                    </div>
                                    <div class="d-grid mb-5">
                                        <button class="btn btn-kalasewa btn-lg btn-block" type="submit">Simpan
                                            perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
        <script src="{{ asset('seller/inputangka.js') }}"></script>
    @endsection
