@extends('layout-seller.layout-seller')
@section('content')
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="mb-3 pb-1">
                <span class="h1 fw-bold mb-0">Mohon isi informasi Anda</span>
            </div>
            <div class="card" style="border-radius: 1rem;">
                <div class="row">
                    <!-- FORM REGISTER PERTAMA -->
                    <div class="d-md-block align-items-center">
                        <div class="card-body p-4 p-lg-5 text-black">

                            <form action="{{ route('seller.registerInformationActionSeller') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        {{ $errors->first() }}
                                    </div>
                                @endif
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="text" id="email" class="form-control form-control-lg" name="email"
                                        value="{{ session('emailRegis') }}" disabled />
                                </div>

                                <div class="form-outline mb-4">
                                    <label for="validpassword" class="form-label">Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="validpassword" name="password"
                                            minlength="8" required>
                                    </div>
                                    <div id="password" class="form-text">Minimal 8 karakter
                                    </div>
                                </div>

                                <h5 class="fw-bold mb-3 pb-3" style="letter-spacing: 1px;">Informasi Pribadi
                                </h5>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="nama">Nama Sesuai Identitas</label>
                                    <input type="text" id="nama" class="form-control form-control-lg" name="nama"
                                        required />
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form2Example17">Nomor Identitas (NIK)</label>
                                    <input type="text" id="form2Example17" class="form-control form-control-lg"
                                        name="nomor_identitas" required />
                                    <div id="password" class="form-text">Harap masukan identitas anda untuk
                                        proses verifikasi demi mengurangi kejadian yang tidak diinginkan</div>
                                </div>

                                <div class="d-grid mb-5">
                                    <div class="mb-4">
                                        <label for="formFile" class="form-label">Foto Identias</label>
                                        <input class="form-control" type="file" id="formFile" name="foto_identitas"
                                            accept=".jpg,.png" required>
                                    </div>
                                </div>

                                <h5 class="fw-bold mb-3 pb-3" style="letter-spacing: 1px;">Informasi Toko
                                </h5>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form2Example17">Nama Toko</label>
                                    <input type="text" id="form2Example17" class="form-control form-control-lg"
                                        name="namaToko" required />
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form2Example17">Link Sosial Media</label>
                                    <input type="text" id="form2Example17" class="form-control form-control-lg"
                                        name="link_sosial_media" required />
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="nomor_telpon">Nomor Telpon Toko</label>
                                    <input type="text" id="nomor_telpon" class="form-control form-control-lg"
                                        name="nomor_telpon" pattern="[0-9]*" minlength="10" maxlength="14" required />
                                </div>

                                <div class="form-outline mb-4">
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
                                    <div id="provinsi" class="form-text">Mohon maaf saat ini kami hanya melayani
                                        wilayah
                                        bandung saja
                                    </div>
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
                                    <div class="form-outline">
                                        <label class="form-label" for="kodePos">Kode Pos</label>
                                        <input type="text" id="kodePos" class="form-control" name="kodePos"
                                            pattern="[0-9]*" minlength="5" maxlength="6" required />
                                    </div>
                                </div>

                                <div class="mb-5">
                                    <label class="form-label">Metode Pengiriman yang anda terima</label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="grab" value="Grab"
                                            name="metode_kirim[]">
                                        <label class="form-check-label" for="grab">Grab</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="GoSend" value="GoSend"
                                            name="metode_kirim[]">
                                        <label class="form-check-label" for="GoSend">GoSend</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="jne" value="JNE"
                                            name="metode_kirim[]">
                                        <label class="form-check-label" for="jne">JNE</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="jnt" value="JNT"
                                            name="metode_kirim[]">
                                        <label class="form-check-label" for="jnt">JNT</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="paxel" value="Paxel"
                                            name="metode_kirim[]">
                                        <label class="form-check-label" for="paxel">Paxel</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="siCepat" value="siCepat"
                                            name="metode_kirim[]">
                                        <label class="form-check-label" for="siCepat">Si Cepat</label>
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
