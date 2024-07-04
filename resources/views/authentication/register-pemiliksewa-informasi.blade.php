@extends('layout.layout-seller')
@section('content')
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="mb-3 pb-1">
                <div class="h1 fw-bold mb-3">Register Sebagai Pemilik Sewa</div>
                <div class="h3 fw-bold mb-0">Mohon isi informasi Anda</div>
            </div>
            <div class="card" style="border-radius: 1rem;">
                <div class="row">
                    <!-- FORM REGISTER PERTAMA -->
                    <div class="d-md-block align-items-center">
                        <div class="card-body p-4 p-lg-5 text-black">

                            <form action="{{ route('registerInformationActionPemilikSewa') }}" method="POST"
                                enctype="multipart/form-data" id="registerForm">
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
                                    <input type="password" class="form-control" id="validpassword" name="password"
                                        minlength="8" value="{{ old('password') }}" required>
                                    <div class="form-text error-message text-danger" id="passwordError"></div>
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="password_confirmation">Konfirmasi Password<span
                                            class="text-danger">*</span></label>
                                    <input type="password" id="password_confirmation" class="form-control error-check"
                                        name="password_confirmation" minlength="8"
                                        value="{{ old('password_confirmation') }}" required />
                                    <div class="form-text error-message text-danger" id="konfirmasi_error"></div>
                                    @error('password')
                                        <div class="text-danger form-text error-message" data-milik="password_confirmation">
                                            {{ $message }}</div>
                                    @enderror
                                </div>

                                <h5 class="fw-bold pb-3" style="letter-spacing: 1px;">Informasi Pribadi
                                </h5>

                                <div class="d-grid">
                                    <div class="mb-4">
                                        <label for="formFile" class="form-label">Foto KTP<span
                                                class="text-danger">*</span></label>
                                        <input class="form-control" type="file" id="formFile" name="foto_identitas"
                                            accept=".jpg,.png,.jpeg,.webp">
                                        <div id="HELP" class="form-text">Dapat Menggunakan Kartu Identitas Orang
                                            Tua/Wali
                                            jika anda masih dibawah umur</div>
                                        <div class="form-text error-message text-danger" id="FileError"></div>
                                    </div>
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="nama">Nama Sesuai Identitas<span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="nama" class="form-control form-control-lg error-check"
                                        name="nama" value="{{ old('nama') }}" required />
                                    <div id="HELP" class="form-text">Nama harus sesuai dengan foto yang di upload!
                                    </div>
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="NIK">Nomor Identitas (NIK)<span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="NIK" class="form-control form-control-lg error-check"
                                        name="nomor_identitas" pattern="[0-9]*" minlength="16"
                                        value="{{ old('nomor_identitas') }}" required
                                        @error('nomor_identitas')
                                                            style="border-color:#D44E4E"
                                                        @enderror />
                                    <div id="HELP" class="form-text">Nomor Identitas harus sesuai dengan foto yang di
                                        upload!</div>
                                    <div class="form-text error-message text-danger" id="NIKError"></div>
                                    @error('nomor_identitas')
                                        <div class="text-danger form-text error-message" data-milik="nomor_identitas">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <h5 class="fw-bold mb-3 pb-3" style="letter-spacing: 1px;">Informasi Toko
                                </h5>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="namaToko">Nama Toko<span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="namaToko" class="form-control form-control-lg error-check"
                                        name="namaToko" value="{{ old('namaToko') }}" required
                                        @error('namaToko')
                                                            style="border-color:#D44E4E"
                                                        @enderror />
                                    @error('namaToko')
                                        <div class="text-danger form-text error-message" data-milik="namaToko">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="linkSosmed">Link Sosial Media<span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="linkSosmed"
                                        class="form-control form-control-lg error-check" name="link_sosial_media"
                                        value="{{ old('link_sosial_media') }}" required
                                        @error('link_sosial_media')
                                                            style="border-color:#D44E4E"
                                                        @enderror />
                                    <div id="link_helper" class="form-text">Mohon masukkan Link Sosial Media Valid. Misal
                                        https://www.instagram.com/akun_anda/
                                    </div>
                                    @error('link_sosial_media')
                                        <div class="text-danger form-text error-message" data-milik="link_sosial_media">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="nomor_telpon">Nomor Telpon Toko<span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="nomor_telpon"
                                        class="form-control form-control-lg error-check" name="nomor_telpon"
                                        pattern="[0-9]*" minlength="10" maxlength="13"
                                        value="{{ old('nomor_telpon') }}" required
                                        @error('nomor_telpon')
                                                            style="border-color:#D44E4E"
                                                        @enderror />
                                    <div id="HELP" class="form-text">Harap masukkan nomor telpon toko yang dapat
                                        dihubungi!
                                    </div>
                                    @error('nomor_telpon')
                                        <div class="text-danger form-text error-message" data-milik="nomor_telpon">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <div class="form-text error-message text-danger" id="nomorTelponError"></div>
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form2Example27">Alamat Toko<span
                                            class="text-danger">*</span></label>
                                    <textarea type="text" id="alamat" class="form-control form-control-lg error-check" name="AlamatToko" required
                                        @error('AlamatToko')
                                                            style="border-color:#D44E4E"
                                                        @enderror>{{ old('AlamatToko') }}</textarea>
                                    <div id="HELP" class="form-text">Harap masukkan alamat toko secara valid untuk
                                        keperluan
                                        informasi pengiriman!</div>
                                    @error('AlamatToko')
                                        <div class="text-danger form-text error-message" data-milik="AlamatToko">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-floating mb-4">
                                    <select class="form-select error-check" id="provinsi" name="provinsi"
                                        aria-label="Floating label select example" required
                                        @error('provinsi')
                                                            style="border-color:#D44E4E"
                                                        @enderror>
                                        <option selected> </option>
                                        <option value="Jawa Barat"
                                            {{ old('provinsi') == 'Jawa Barat' ? 'selected' : '' }}>Jawa Barat
                                        </option>
                                    </select>
                                    <label for="provinsi">Provinsi<span class="text-danger">*</span></label>
                                    @error('provinsi')
                                        <div class="text-danger form-text error-message" data-milik="provinsi">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-floating mb-4">
                                    <select class="form-select error-check" id="kota" name="kota"
                                        aria-label="Floating label select example" required
                                        @error('kota')
                                                            style="border-color:#D44E4E"
                                                        @enderror>
                                        <option selected> </option>
                                        <option value="Kota Bandung"
                                            {{ old('kota') == 'Kota Bandung' ? 'selected' : '' }}>Kota Bandung</option>
                                        <option value="Kabupaten Bandung"
                                            {{ old('kota') == 'Kabupaten Bandung' ? 'selected' : '' }}>Kabupaten
                                            Bandung
                                        </option>
                                    </select>
                                    <label for="kota">Kota/Kabupaten<span class="text-danger">*</span></label>
                                    @error('kota')
                                        <div class="text-danger form-text error-message" data-milik="kota">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="d-grid mb-5">
                                    <div class="form-outline">
                                        <label class="form-label" for="kodePos">Kode Pos<span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="kodePos" class="form-control error-check"
                                            name="kodePos" pattern="[0-9]*" minlength="5" maxlength="5"
                                            value="{{ old('kodePos') }}" required
                                            @error('kodePos')
                                                            style="border-color:#D44E4E"
                                                        @enderror />
                                    </div>
                                    <div class="form-text error-message text-danger" id="kodePosError"></div>
                                    @error('kodePos')
                                        <div class="text-danger form-text error-message" data-milik="kodePos">
                                            {{ $message }}
                                        </div>
                                    @enderror
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
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="{{ asset('seller/validasiRegisPemilik.js') }}"></script>
    </section>
@endsection
