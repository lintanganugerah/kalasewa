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
                                <button class="nav-link active" id="Produkanda-tab" data-bs-toggle="tab"
                                    onclick="window.location.href='/produk/produkanda'" type="button" role="tab"
                                    aria-controls="Produkanda" aria-selected="true">Produk
                                    Anda</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="tambahProduk-tab"
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
                                <h5 class="card-title">Produk Aktif</h5>
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
                                <div class="row">
                                    @foreach ($produk as $prod)
                                        @if ($prod->status_produk == 'aktif')
                                            <div class="col-md-3 col-sm-6 mb-4">
                                                <div class="card p-3" style="width: 100%;">
                                                    <div class="image-container">
                                                        @foreach ($fotoProduk->where('ID_produk', $prod->id)->take(1) as $fp)
                                                            <img src="{{ asset($fp->path) }}" alt="...">
                                                        @endforeach
                                                    </div>
                                                    <div class="product-details">
                                                        <h5 class="card-title mt-2">{{ $prod->nama_produk }}</h5>
                                                        <p class="cut-text"> {{ $prod->deskripsi_produk }}
                                                        </p>
                                                        @foreach ($prod->ukuran_produk as $ukuran => $detail)
                                                            <li>Ukuran: {{ $ukuran }} - Harga: {{ $detail['harga'] }}
                                                                - Stok: {{ $detail['stok'] }}</li>
                                                        @endforeach
                                                        <p> Metode Kirim :
                                                            @foreach (json_decode($prod->metode_kirim) as $metode)
                                                                {{ $metode }}
                                                            @endforeach
                                                        </p>
                                                    </div>
                                                    <div class="d-flex mt-2">
                                                        <a href="{{ route('seller.viewEditProduk', $prod->id) }}"
                                                            class="btn btn-primary mr-2">Edit</a>
                                                        <form
                                                            action="{{ route('seller.arsipProduk', $prod->id) }}"method="POST">
                                                            @csrf
                                                            <button type="submit"
                                                                class="btn btn-primary mr-2">Arsipkan</button>
                                                        </form>
                                                        <form action="{{ route('seller.hapusProduk', $prod->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger mr-2"
                                                                onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">Hapus</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <hr class="bg-secondary border-5 border-top border-secondary mb-5" />
                                <h5 class="card-title">Produk Diarsipkan (Tidak ditampilkan pada marketplace)</h5>
                                <div class="row">
                                    @foreach ($produk as $prod)
                                        @if ($prod->status_produk == 'arsip')
                                            <div class="col-md-3 col-sm-6 mb-4">
                                                <div class="card p-3" style="width: 100%;">
                                                    <div class="image-container">
                                                        @foreach ($fotoProduk->where('ID_produk', $prod->id)->take(1) as $fp)
                                                            <img src="{{ asset($fp->path) }}" alt="...">
                                                        @endforeach
                                                    </div>
                                                    <div class="product-details">
                                                        <h5 class="card-title mt-2">{{ $prod->nama_produk }}</h5>
                                                        <p class="cut-text"> {{ $prod->deskripsi_produk }}
                                                        </p>
                                                        @foreach ($prod->ukuran_produk as $ukuran => $detail)
                                                            <li>Ukuran: {{ $ukuran }} - Harga:
                                                                {{ $detail['harga'] }}
                                                                - Stok: {{ $detail['stok'] }}</li>
                                                        @endforeach
                                                        <p> Metode Kirim :
                                                            @foreach (json_decode($prod->metode_kirim) as $metode)
                                                                {{ $metode }}
                                                            @endforeach
                                                        </p>
                                                    </div>
                                                    <div class="d-flex mt-2">
                                                        <a href="{{ route('seller.viewEditProduk', $prod->id) }}"
                                                            class="btn btn-primary mr-2">Edit</a>
                                                        <form
                                                            action="{{ route('seller.aktifkanProduk', $prod->id) }}"method="POST">
                                                            @csrf
                                                            <button type="submit"
                                                                class="btn btn-primary mr-2">Aktifkan</button>
                                                        </form>
                                                        <form action="{{ route('seller.hapusProduk', $prod->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger mr-2"
                                                                onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">Hapus</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
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
