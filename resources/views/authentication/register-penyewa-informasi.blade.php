@extends('layout.layout-seller')
@section('content')
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="mb-3 pb-1">
                <div class="h1 fw-bold mb-3">Register Sebagai Penyewa</div>
                <div class="h3 fw-bold mb-0">Mohon isi informasi Anda</div>
            </div>
            <div class="card" style="border-radius: 1rem;">
                <div class="row">
                    <!-- FORM REGISTER PERTAMA -->
                    <div class="d-md-block align-items-center">
                        <div class="card-body p-4 p-lg-5 text-black">

                            <form action="{{ route('registerInformationActionPenyewa') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        {{ $errors->first() }}
                                    </div>
                                @endif
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="email">Email<span class="text-danger">*</span></label>
                                    <input type="text" id="email" class="form-control form-control-lg" name="email"
                                        value="{{ session('email') }}" disabled />
                                </div>

                                <div class="form-outline mb-4">
                                    <label for="validpassword" class="form-label">Password<span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="validpassword" name="password"
                                            minlength="8" required>
                                    </div>
                                    <div id="password" class="form-text">Minimal 8 karakter
                                    </div>
                                </div>

                                <h5 class="fw-bold mb-3 pb-3" style="letter-spacing: 1px;">Informasi Pribadi
                                </h5>

                                <div class="d-grid">
                                    <div class="mb-4">
                                        <label for="formFile" class="form-label">Foto KTP<span
                                                class="text-danger">*</span></label>
                                        <input class="form-control" type="file" id="formFile" name="foto_identitas"
                                            accept=".jpg,.png,.jpeg,.webp" required>
                                        <div id="password" class="form-text">Dapat Menggunakan Kartu Identitas Orang
                                            Tua/Wali jika anda masih dibawah umur</div>
                                    </div>
                                </div>
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="nama">Nama Lengkap<span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="nama" class="form-control form-control-lg" name="nama"
                                        required />
                                    <div id="HELPER" class="form-text">Nama harus sesuai dengan foto yang di upload!
                                    </div>
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form2Example17">Nomor Identitas Kependudukan (NIK)<span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="form2Example17" class="form-control form-control-lg"
                                        name="nomor_identitas" required />
                                    <div id="HELPER" class="form-text">Nomor Identitas harus sesuai dengan foto yang di
                                        upload!</div>
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="nomor_telpon">Nomor Telpon<span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="nomor_telpon" class="form-control form-control-lg"
                                        name="nomor_telpon" pattern="[0-9]*" minlength="10" maxlength="14" required />
                                    <div id="HELPER" class="form-text">Nomor pribadi yang dapat dihubungi</div>
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="nomor_telpon_darurat">Nomor Telpon Darurat<span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="nomor_telpon_darurat" class="form-control form-control-lg"
                                        name="nomor_telpon_darurat" pattern="[0-9]*" minlength="10" maxlength="14"
                                        required />
                                    <div id="HELPER" class="form-text">Nomor darurat yang dapat dihubungi</div>
                                </div>

                                <div class="d-grid">
                                    <div class="mb-4">
                                        <label for="formFile" class="form-label">Foto Diri<span
                                                class="text-danger">*</span></label>
                                        <input class="form-control" type="file" id="formFile" name="foto_diri"
                                            accept=".jpg,.png,.jpeg,.webp" required>
                                        <div id="HELPER" class="form-text">Pastikan Wajah Terlihat Dengan Jelas dan
                                            Sesuai
                                            dengan identitas!</div>
                                    </div>
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form2Example17">Link Sosial Media<span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="form2Example17" class="form-control form-control-lg"
                                        name="link_sosial_media" required />
                                    <div id="password" class="form-text">Misal https://www.instagram.com/akun_anda/
                                    </div>
                                </div>


                                <div data-mdb-input-init class="form-outline mb-4">
                                    <label class="form-label" for="form2Example27">Alamat<span
                                            class="text-danger">*</span></label>
                                    <textarea type="text" id="alamat" class="form-control form-control-lg" name="alamat" required></textarea>
                                </div>


                                <div class="form-floating mb-4">
                                    <select class="form-select" id="floatingSelect" name="provinsi"
                                        aria-label="Floating label select example" required>
                                        <option selected> </option>
                                        <option value="Jawa Barat">Jawa Barat</option>
                                    </select>
                                    <label for="floatingSelect">Provinsi<span class="text-danger">*</span></label>
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
                                    <label for="floatingSelect">Kota/Kabupaten<span class="text-danger">*</span></label>
                                </div>

                                <div class="d-grid mb-5">
                                    <div class="form-outline">
                                        <label class="form-label" for="kodePos">Kode Pos<span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="kodePos" class="form-control" name="kodePos"
                                            pattern="[0-9]*" minlength="5" maxlength="6" required />
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
