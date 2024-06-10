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
                            <form action="{{ route('buyer.updateProfile') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        {{ $errors->first() }}
                                    </div>
                                @endif
                                <h5 class="fw-bold mb-3 pb-3" style="letter-spacing: 1px;">Informasi Identitas</h5>

                                <div data-mdb-input-init class="form-outline mb-4">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="text" id="email" class="form-control form-control-lg" value="{{ $user->email }}" disabled />
                                </div>

                                <div data-mdb-input-init class="form-outline mb-4">
                                    <label class="form-label" for="nama">Nama Lengkap Pribadi</label>
                                    <input type="text" id="nama" class="form-control form-control-lg" name="nama" value="{{ $user->nama }}" required />
                                    <div id="provinsi" class="form-text">Mohon masukkan nama lengkap asli anda untuk keperluan verifikasi</div>
                                </div>

                                <div data-mdb-input-init class="form-outline mb-4">
                                    <label class="form-label" for="noTelp">Nomor Telpon</label>
                                    <input type="text" id="noTelp" class="form-control form-control-lg" name="noTelp" pattern="[0-9]*" minlength="10" maxlength="14" value="{{ $user->no_telp }}" required />
                                </div>

                                <div data-mdb-input-init class="form-outline mb-4">
                                    <label class="form-label" for="nik">NIK</label>
                                    <input type="number" id="nik" class="form-control form-control-lg" name="nik" minlength="16" value="{{ $user->NIK }}" disabled />
                                </div>

                                <div data-mdb-input-init class="form-outline mb-4">
                                    <label class="form-label" for="alamat">Alamat</label>
                                    <textarea id="alamat" class="form-control form-control-lg" name="alamat" required>{{ $user->alamat }}</textarea>
                                </div>

                                <div class="form-floating mb-4">
                                    <select class="form-select" id="floatingSelect" name="provinsi" aria-label="Floating label select example" required>
                                        <option value=""> </option>
                                        <option value="Jawa Barat" {{ $user->provinsi == 'Jawa Barat' ? 'selected' : '' }}>Jawa Barat</option>
                                        <!-- <option value="Jawa Barat" {{ $user->provinsi == 'Jawa Barat' ? 'selected' : '' }}>Jawa Barat</option> -->
                                    </select>
                                    <label for="floatingSelect">Provinsi</label>
                                    <div id="provinsi" class="form-text">Mohon maaf saat ini kami hanya melayani wilayah Bandung saja</div>
                                </div>

                                <div class="form-floating mb-4">
                                    <select class="form-select" id="floatingSelect" name="kota" aria-label="Floating label select example" required>
                                        <option value=""> </option>
                                        <option value="Kota Bandung" {{ $user->kota == 'Kota Bandung' ? 'selected' : '' }}>Kota Bandung</option>
                                        <option value="Kabupaten Bandung" {{ $user->kota == 'Kabupaten Bandung' ? 'selected' : '' }}>Kabupaten Bandung</option>
                                    </select>
                                    <label for="floatingSelect">Kota/Kabupaten</label>
                                </div>

                                <div class="d-grid mb-5">
                                    <div data-mdb-input-init class="form-outline">
                                        <label class="form-label" for="kodePos">Kode Pos</label>
                                        <input type="text" id="kodePos" class="form-control" name="kodePos" pattern="[0-9]*" minlength="5" maxlength="6" value="{{ $user->kode_pos }}" required />
                                    </div>
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
