@extends('layout-seller.selllayout')
@section('content')
    <div class="row">
        <div class="col">
            <div class="text-left mb-5 mt-3">
                <h1 class="fw-bold text-secondary">Produk</h1>
                <h4 class="fw-semibold text-secondary">Manajemen Produk Anda disini</h4>
            </div>

            <div class="row gx-5">

                <div class="card">
                    <div class="card-header">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="Produkanda-tab" data-bs-toggle="tab"
                                    onclick="window.location.href='/produk/produkanda'" type="button" role="tab"
                                    aria-controls="Produkanda" aria-selected="true">Produk
                                    Anda</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="tambahProduk-tab"
                                    onclick="window.location.href='/produk/tambahproduk'" type="button" role="tab"
                                    aria-controls="tambahProduk" aria-selected="false">Tambah
                                    Produk</button>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="Informasi" role="tabpanel"
                                aria-labelledby="Informasi-tab">
                                <h5 class="card-title">Informasi Produk</h5>
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
                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                <form action="{{ route('seller.tambahProdukAction') }}" id="formproduk" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="userPhoto" class="form-label">Foto Produk</label>
                                        <div id="photoInputs">
                                            <div class="photo-input mb-2">
                                                <div class="d-flex align-items-start">
                                                    <div class="me-3">
                                                        <img class="img-thumbnail" src=""
                                                            style="width: 150px; height: 150px; object-fit: cover;"
                                                            alt="Foto Produk">
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <input type="file" name="foto_produk[]"
                                                        class="form-control userPhoto" accept=".jpg,.png,.jpeg" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <small class="form-text text-muted">
                                                <ul>
                                                    <li>Disarankan Rasio foto 1:1 atau object berada di tengah</li>
                                                    <li>Ukuran max 5MB</li>
                                                    <li>JPG, JPEG, PNG</li>
                                                </ul>
                                            </small>
                                        </div>
                                        <button type="button" id="addPhotoBtn" class="btn text-white"
                                            style="background-color: #D44E4E">Tambah Foto</button>
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Nama Produk</label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1"
                                            name="namaProduk" required>
                                        <div id="namaProduk" class="form-text" style="opacity: 50%;">Disarankan untuk
                                            memasukkan nama series pada
                                            produk agar penyewa gampang menemukan dari seris apa produks cosplay anda</div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Deskripsi Produk</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="deskripsiProduk" required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Brand</label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1"
                                            name="brand" required>
                                        <div id="namaProduk" class="form-text" style="opacity: 50%;">Jika tidak ada brand
                                            silahkan tuliskan Buatan Sendiri/No Brand</div>
                                    </div>
                                    <label for="selectSeries" class="form-label">Series</label>
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="selectSeries" name="series" required>
                                            <option></option>
                                            @foreach ($series as $sr)
                                                <option value="{{ $sr->id }}">{{ $sr->series }}</option>
                                            @endforeach
                                        </select>
                                        <label for="selectSeries">Series</label>
                                    </div>
                                    <label for="selectGender" class="form-label">Gender</label>
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="selectGender" name="gender" required>
                                            <option></option>
                                            <option value="Pria">Pria</option>
                                            <option value="Wanita">Wanita</option>
                                        </select>
                                    </div>
                                    <label for="hargaInput" class="form-label">Harga</label>
                                    <div class="input-group mb-3">
                                        <div class="form-floating">
                                            <input type="text" id="hargaInput" class="form-control" name="harga"
                                                placeholder="Harga" required>
                                            <label for="hargaInput">Harga / 3
                                                hari</label>
                                        </div>
                                        <span id="harga_span" class="input-group-text fw-100">/ 3 hari</span>
                                    </div>
                                    <hr class="border border-secondary border-3 my-5">
                                    <!-- Informasi Pengiriman -->
                                    <h5 class="card-title">Informasi Ukuran</h5>
                                    <div class="mb-3">
                                        <label class="form-label">Ukuran Produk</label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input ukuran-checkbox" type="checkbox"
                                                id="S" value="S" name="ukuran[]" data-target="S">
                                            <label class="form-check-label" for="S">S</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input ukuran-checkbox" type="checkbox"
                                                id="M" value="M" name="ukuran[]" data-target="M">
                                            <label class="form-check-label" for="M">M</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input ukuran-checkbox" type="checkbox"
                                                id="L" value="L" name="ukuran[]" data-target="L">
                                            <label class="form-check-label" for="L">L</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input ukuran-checkbox" type="checkbox"
                                                id="XL" value="XL" name="ukuran[]" data-target="XL">
                                            <label class="form-check-label" for="XL">XL</label>
                                        </div>
                                    </div>
                                    <div id="ukuranInputs">
                                        <!-- Kontainer untuk input harga dan stok yang akan ditambahkan secara dinamis -->
                                    </div>
                                    <hr class="border border-secondary border-3 my-5">
                                    <!-- Informasi Pengiriman -->
                                    <h5 class="card-title">Informasi Pengiriman</h5>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Berat Produk</label>
                                        <input type="number" class="form-control" id="beratProduk" name="beratProduk"
                                            required>
                                        <div id="helpberat" class="form-text" style="opacity: 50%;">Masukan dalam satuan
                                            gram. 1000g = 1kg</div>
                                    </div>
                                    <div class="mb-5">
                                        <label class="form-label">Metode Pengiriman</label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="grab"
                                                value="Grab" name="metode_kirim[]">
                                            <label class="form-check-label" for="grab">Grab</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="goSend"
                                                value="GoSend" name="metode_kirim[]">
                                            <label class="form-check-label" for="goSend">GoSend</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="jne"
                                                value="JNE" name="metode_kirim[]">
                                            <label class="form-check-label" for="jne">JNE</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="jnt"
                                                value="JNT" name="metode_kirim[]">
                                            <label class="form-check-label" for="jnt">JNT</label>
                                        </div>
                                    </div>
                                    <div class="d-grid mb-5">
                                        <button class="btn btn-kalasewa btn-lg btn-block" type="submit">Buat
                                            Produk</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <script>
        $('#selectSeries').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            width: $(this).data('height') ? $(this).data('height') : $(this).hasClass('h-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
        });
        $('#selectGender').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            width: $(this).data('height') ? $(this).data('height') : $(this).hasClass('h-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
        });
    </script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- Bootstrap JS (Optional, if you need Bootstrap JS features) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('seller/inputangka.js') }}"></script>
    <script src="{{ asset('seller/inputfotoproduk.js') }}"></script>
@endsection
