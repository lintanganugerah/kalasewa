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
                                <button class="nav-link active text-secondary fw-bold" id="Produkanda-tab"
                                    data-bs-toggle="tab" onclick="window.location.href='/status-sewa/belumdiproses'"
                                    type="button" role="tab" aria-controls="Produkanda" aria-selected="true">Belum
                                    Diproses</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link text-secondary" id="tambahProduk-tab"
                                    onclick="window.location.href='/status-sewa/dalampengiriman'" type="button"
                                    role="tab" aria-controls="tambahProduk" aria-selected="false">Dalam
                                    Pengiriman</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link text-secondary" id="tambahProduk-tab"
                                    onclick="window.location.href='/status-sewa/sedangberlangsung'" type="button"
                                    role="tab" aria-controls="tambahProduk" aria-selected="false">Sedang
                                    Berlangsung</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link text-secondary" id="tambahProduk-tab"
                                    onclick="window.location.href='/status-sewa/telahkembali'" type="button" role="tab"
                                    aria-controls="tambahProduk" aria-selected="false">Penyewaan Telah kembali</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link text-secondary" id="tambahProduk-tab"
                                    onclick="window.location.href='/status-sewa/penyewaandiretur'" type="button"
                                    role="tab" aria-controls="tambahProduk" aria-selected="false">Penyewaan
                                    diretur</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link text-secondary" id="tambahProduk-tab"
                                    onclick="window.location.href='/status-sewa/riwayat'" type="button" role="tab"
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
                                    <table id="tabel" class="no-more-tables table w-100 tabel-data align-items-center"
                                        style="word-wrap: break-word;">
                                        @if ($order)
                                            <thead>
                                                <tr>
                                                    <th>Nomor Order</th>
                                                    <th class="col-2">Produk</th>
                                                    <th>Penyewa</th>
                                                    <th>Ukuran</th>
                                                    <th>Kurir</th>
                                                    <th class="col-3">Tujuan Pengiriman</th>
                                                    <th>Additional</th>
                                                    <th>Periode Sewa</th>
                                                    <th>Total Harga</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($order as $ord)
                                                    <tr>
                                                        <td data-title="No. Order" class="align-middle">
                                                            {{ $ord->nomor_order }}</td>
                                                        <td data-title="Produk" class="align-middle">
                                                            <h5 class="">{{ $ord->id_produk_order->nama_produk }}</h5>
                                                            <small class="fw-light" href=""
                                                                style="font-size:14px">{{ $ord->id_produk_order->brand }},
                                                                Rp.{{ number_format($ord->id_produk_order->harga) }}/3hari</small>
                                                        </td>
                                                        <td data-title="Nama Penyewa" class="align-middle">
                                                            <h5>{{ $ord->id_penyewa_order->nama }}</h5>
                                                            <a class="fw-light"
                                                                href="{{ route('seller.view.penilaian.reviewPenyewa', $ord->id_penyewa_order->id) }}"
                                                                style="font-size:14px">Lihat Review
                                                                Penyewa</a>
                                                        </td>
                                                        <td data-title="Ukuran" class="align-middle">
                                                            {{ $ord->id_produk_order->ukuran_produk }}</td>
                                                        <td data-title="Kurir" class="align-middle">
                                                            {{ $ord->metode_kirim }}</td>
                                                        <td data-title="Tujuan Pengiriman" class="align-middle">
                                                            {{ $ord->tujuan_pengiriman }}
                                                        </td>
                                                        <td data-title="Additional" class="align-middle text-opacity-75">
                                                            @if ($ord->additional)
                                                                <ul>
                                                                    @foreach ($ord->additional as $nama => $harga)
                                                                        <li>{{ $nama }} +{{ $harga }}</li>
                                                                    @endforeach
                                                                </ul>
                                                            @else
                                                                <div class="text-opacity-25">-</div>
                                                            @endif
                                                        </td>
                                                        <td data-title="Periode Sewa" class="align-middle">
                                                            {{ $ord->tanggalFormatted($ord->tanggal_mulai) }} <span
                                                                class="fw-bolder"> s.d. </span>
                                                            {{ $ord->tanggalFormatted($ord->tanggal_selesai) }}
                                                        </td>
                                                        <td data-title="Total Harga" class="align-middle">
                                                            Rp {{ number_format($ord->total_harga, 0, '', '.') }}</td>
                                                        <td data-title="aksi" class="align-middle">
                                                            <a type="button" data-bs-toggle="modal"
                                                                data-bs-target="#inputResi-{{ $ord->nomor_order }}"
                                                                class="d-grid btn btn-success m-2"
                                                                id="proses-{{ $ord->nomor_order }}">Input
                                                                Resi</a>
                                                            <a href="" class="d-grid btn btn-outline-success m-2"
                                                                id="proses">Chat</a>
                                                            <a class="d-grid btn btn-outline-danger m-2"
                                                                id="aksi-batalkan-{{ $ord->nomor_order }}" type="button"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#batalkan-{{ $ord->nomor_order }}">Batalkan</button>
                                                        </td>
                                                    </tr>
                                                    <!-- Modal Input Resi -->
                                                    <div class="modal fade" id="inputResi-{{ $ord->nomor_order }}"
                                                        tabindex="-1"
                                                        aria-labelledby="inputResi-{{ $ord->nomor_order }}Label"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <form
                                                                action="{{ route('seller.statuspenyewaan.inputResi', $ord->nomor_order) }}"
                                                                method="POST">
                                                                @csrf
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title fs-5"
                                                                            id="inputResi-{{ $ord->nomor_order }}Label">
                                                                            Input Resi</h1>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="m-2">
                                                                            <p for="exampleFormControlInput1"
                                                                                class="form-label">Nomor Order :
                                                                                {{ $ord->nomor_order }}</p>
                                                                            <p for="exampleFormControlInput1"
                                                                                class="form-label">Produk :
                                                                                {{ $ord->id_produk_order->nama_produk }}
                                                                            </p>
                                                                            <small class="fw-light mb-3" href=""
                                                                                style="font-size:14px">{{ $ord->id_produk_order->brand }},
                                                                                Rp.{{ number_format($ord->id_produk_order->harga) }}/3hari,
                                                                                Ukuran
                                                                                {{ $ord->id_produk_order->ukuran_produk }}</small>
                                                                            <hr
                                                                                class="border border-secondary opacity-50 my-4">
                                                                            <label for="inputResi"
                                                                                class="form-label">Nomor
                                                                                Resi</label>
                                                                            <input type="text" class="form-control"
                                                                                name="nomor_resi" id="inputResi" required>
                                                                        </div>
                                                                        <p class="m-2 mt-2">Setelah submit nomor resi maka
                                                                            status akan berubah
                                                                            menjadi
                                                                            pengiriman.
                                                                            Pastikan bahwa nomor resi telah sesuai
                                                                        </p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Tutup</button>
                                                                        <button type="submit"
                                                                            class="btn btn-kalasewa">Submit</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <!-- Modal Batalkan -->
                                                    <div class="modal fade" id="batalkan-{{ $ord->nomor_order }}"
                                                        tabindex="-1"
                                                        aria-labelledby="batalkan-{{ $ord->nomor_order }}Label"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <form
                                                                action="{{ route('seller.statuspenyewaan.dibatalkanPemilikSewa', $ord->nomor_order) }}"
                                                                method="POST">
                                                                @csrf
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title fs-5"
                                                                            id="batalkan-{{ $ord->nomor_order }}Label">
                                                                            Batalkan</h1>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="m-2">
                                                                            <p class="mt-2 fw-bold">Anda akan
                                                                                membatalkan Penyewaan berikut :
                                                                            </p>
                                                                            <p for="exampleFormControlInput1"
                                                                                class="form-label">Nomor Order :
                                                                                {{ $ord->nomor_order }}</p>
                                                                            <p for="exampleFormControlInput1"
                                                                                class="form-label">Produk :
                                                                                {{ $ord->id_produk_order->nama_produk }}
                                                                            </p>
                                                                            <small class="fw-light mb-3" href=""
                                                                                style="font-size:14px">{{ $ord->id_produk_order->brand }},
                                                                                Rp.{{ number_format($ord->id_produk_order->harga) }}/3hari,
                                                                                Ukuran
                                                                                {{ $ord->id_produk_order->ukuran_produk }}</small>
                                                                            <hr
                                                                                class="border border-secondary opacity-50 my-4">
                                                                            <label for="alasan_batal"
                                                                                class="form-label">Alasan
                                                                                Pembatalan</label>
                                                                            <textarea type="text" class="form-control" name="alasan_batal" id="alasan_batal" required> </textarea>
                                                                        </div>
                                                                        <p class="m-2 mt-2">Pastikan anda telah berdiskusi
                                                                            dengan user terkait pembatalan penyewaan ini
                                                                        </p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Tutup</button>
                                                                        <button type="submit"
                                                                            class="btn btn-kalasewa">Submit</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </tbody>
                                        @endif
                                    </table>
                                </div>
                                {{-- Modal Peringatan --}}
                                <div class="modal" id="modal_auto" tabindex="-1"
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
                                                    bermasalah saat tiba di penyewa atau saat kembali lagi ke anda
                                                </p>
                                                <p>Mohon kirimkan barang
                                                    <span class="fw-bolder text-danger">sebelum awal mulai periode
                                                        sewa</span>.
                                                    Jika awal mulai sewa adalah 15, maka kirimkan tanggal 14
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                Klik diluar popup ini untuk menutup
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
        });
    </script>
    <script src="{{ asset('seller/modal_auto_muncul.js') }}"></script>
    <script src="{{ asset('seller/inputangka.js') }}"></script>
    <script src="{{ asset('seller/inputfotoproduk.js') }}"></script>
@endsection

<style>
    .product-image-container {
        width: 100px;
        height: 100px;
        overflow: hidden;
    }

    .product-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    @media (max-width: 1199px) {
        .text-lg-end {
            text-align: left !important;
        }

        .col-lg-6 {
            margin-top: 1rem;
        }

        .product-image-container-tabel {
            display: none;
        }
    }

    table {
        border-collapse: collapse;
        width: 100%;
        border: 0.5px solid #ddd;
    }
</style>
