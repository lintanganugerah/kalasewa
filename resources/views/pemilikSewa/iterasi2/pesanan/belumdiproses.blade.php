@extends('layout.selllayout')
@section('content')
    <div class="row">
        <div class="col">
            <div class="text-left mb-5 mt-3">
                <h1 class="fw-bold text-secondary">Pesanan</h1>
                <h4 class="fw-semibold text-secondary">Manajemen Pesanan Anda disini</h4>
            </div>

            <div class="row gx-5">

                <div class="card">
                    <div class="card-header">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active text-secondary" id="Produkanda-tab" data-bs-toggle="tab"
                                    onclick="window.location.href='/produk/produkanda'" type="button" role="tab"
                                    aria-controls="Produkanda" aria-selected="true">Belum Diproses</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link text-secondary" id="tambahProduk-tab"
                                    onclick="window.location.href='/produk/tambahproduk'" type="button" role="tab"
                                    aria-controls="tambahProduk" aria-selected="false">Dalam Pengiriman</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link text-secondary" id="tambahProduk-tab"
                                    onclick="window.location.href='/produk/tambahproduk'" type="button" role="tab"
                                    aria-controls="tambahProduk" aria-selected="false">Sedang Berlangsung</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link text-secondary" id="tambahProduk-tab"
                                    onclick="window.location.href='/produk/tambahproduk'" type="button" role="tab"
                                    aria-controls="tambahProduk" aria-selected="false">Penyewaan Telah kembali</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link text-secondary" id="tambahProduk-tab"
                                    onclick="window.location.href='/produk/tambahproduk'" type="button" role="tab"
                                    aria-controls="tambahProduk" aria-selected="false">Penyewaan diretur</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link text-secondary" id="tambahProduk-tab"
                                    onclick="window.location.href='/produk/tambahproduk'" type="button" role="tab"
                                    aria-controls="tambahProduk" aria-selected="false">Riwayat Penyewaan</button>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane fade show active mt-3" id="Informasi" role="tabpanel"
                                aria-labelledby="Informasi-tab">
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
                                <div class="text-dark rounded-3">
                                    <table id="tabel"
                                        class="no-more-tables table table-sm table-light w-100 tabel-data align-items-center"
                                        style="word-wrap: break-word;" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th class="col-2">Produk</th>
                                                <th>Penyewa</th>
                                                <th>Periode Sewa</th>
                                                <th>Ukuran</th>
                                                <th>Pengiriman</th>
                                                <th class="col-3">Alamat Tujuan</th>
                                                <th>Total Harga</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td data-title="#" class="align-middle">1</td>
                                                <td data-title="Produk" class="align-middle">
                                                    <h5 class="">Genshin Impact Yae Miko Fullset Wanita</h5>
                                                </td>
                                                <td data-title="Nama Penyewa" class="align-middle">
                                                    <h5>Card title</h5>
                                                    <a class="fw-light" href="" style="font-size:14px">Lihat Review
                                                        Penyewa</a>
                                                </td>
                                                <td data-title="Periode Sewa" class="align-middle">24 Juni - 27 Juni
                                                </td>
                                                <td data-title="Ukuran" class="align-middle">L</td>
                                                <td data-title="Pengiriman" class="align-middle">JNE</td>
                                                <td data-title="Alamat Tujuan" class="align-middle">Jalan Bulevar Barat No.
                                                    75-89, Summarecon Bandung, Kec. Gedebage, Kota Bandung, Jawa Barat 40295
                                                </td>
                                                <td data-title="Harga" class="align-middle">Rp. 50.000 / 3 hari</td>
                                                <td data-title="aksi" class="align-middle">
                                                    <a href="" class="btn btn-success" id="proses">Input
                                                        Resi</a>
                                                    <a href="" class="btn btn-outline-danger"
                                                        id="aksi-">Tolak</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td data-title="#" class="align-middle">2</td>
                                                <td data-title="Produk" class="align-middle">
                                                    <h5 class="">Wuthering Waves Yinlin Fullset Murah Banget</h5>
                                                </td>
                                                <td data-title="Nama Penyewa" class="align-middle">
                                                    <h5 class="">Card title</h5>
                                                    <a class="fw-light" href="" style="font-size:14px">Lihat
                                                        Review Penyewa</a>
                                                </td>
                                                <td data-title="Periode Sewa" class="align-middle">24 Juni - 27 Juni</td>
                                                <td data-title="Ukuran" class="align-middle">M</td>
                                                <td data-title="Pengiriman" class="align-middle">GoSend</td>
                                                <td data-title="Alamat Tujuan" class="align-middle">Jl. Asia Afrika, Kb.
                                                    Pisang, Kec. Regol, Kota Bandung, Jawa Barat</td>
                                                <td data-title="Harga" class="align-middle">Rp. 100.000 / 3 hari</td>
                                                <td data-title="aksi" class="align-middle">
                                                    <a href="" class="btn btn-success" id="proses">Input
                                                        Resi</a>
                                                    <a href="" class="btn btn-outline-danger"
                                                        id="aksi-">Tolak</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td data-title="#" class="align-middle">3</td>
                                                <td data-title="Produk" class="align-middle">
                                                    <h5 class="">Wuthering Waves</h5>
                                                </td>
                                                <td data-title="Nama Penyewa" class="align-middle">
                                                    <h5 class="">Card title</h5>
                                                    <a class="fw-light" href="" style="font-size:14px">Lihat
                                                        Review Penyewa</a>
                                                </td>
                                                <td data-title="Periode Sewa" class="align-middle">24 Juni - 27 Juni</td>
                                                <td data-title="Ukuran" class="align-middle">S</td>
                                                <td data-title="Pengiriman" class="align-middle">Grab</td>
                                                <td data-title="Alamat Tujuan" class="align-middle">Jl. Sentra Raya Barat,
                                                    Rancabolang, Kec. Gedebage, Kota Bandung, Jawa Barat 40295</td>
                                                <td data-title="Harga" class="align-middle">Rp. 70.000 / 3 hari</td>
                                                <td data-title="aksi" class="align-middle">
                                                    <a href="" class="btn btn-success" id="proses">Input
                                                        Resi</a>
                                                    <a href="" class="btn btn-outline-danger"
                                                        id="aksi-">Tolak</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                {{-- <div class="modal" id="modal_auto" tabindex="-1"
                                    aria-labelledby="exampleModalCenterTitle" aria-modal="true" role="dialog">
                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5 fw-bolder" id="exampleModalCenterTitle">
                                                    Mohon Perhatian</h1>
                                            </div>
                                            <div class="modal-body">
                                                <p>Harap
                                                    <span class="fw-bolder text-danger">rekam video saat pengemasan sebelum
                                                        mengirimkan barang </span> sebagai bukti jika barang
                                                    bermasalah saat tiba di penyewa
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger"
                                                    data-bs-dismiss="modal">Baik, Saya Paham</button>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('.tabel-data').DataTable({
            lengthMenu: [
                [5, 10, 25, -1],
                [5, 10, 25, 'All']
            ],
            // fixedHeader: true,
            // order: [
            //     [6, 'asc']
            // ],
            // rowGroup: {
            //     dataSrc: 6
            // }
        });
    </script>
    <script src="{{ asset('seller/modal_auto_muncul.js') }}"></script>
    <script src="{{ asset('seller/inputangka.js') }}"></script>
    <script src="{{ asset('seller/inputfotoproduk.js') }}"></script>
@endsection
