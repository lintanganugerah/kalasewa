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
                                <button class="nav-link text-secondary" id="Produkanda-tab" data-bs-toggle="tab"
                                    onclick="window.location.href='/status-sewa/belumdiproses'" type="button"
                                    role="tab" aria-controls="Produkanda" aria-selected="true">Belum Diproses</button>
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
                                <button class="nav-link active text-secondary fw-bold" id="tambahProduk-tab"
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
                                    <div class="table-responsive">
                                    <table id="tabel" class="no-more-tables table w-100 tabel-data align-items-center"
                                        style="word-wrap: break-word;">
                                        @if ($order)
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nomor Order</th>
                                                    <th class="col-2">Produk</th>
                                                    <th>Penyewa</th>
                                                    <th>Ukuran</th>
                                                    <th>Additional</th>
                                                    <th>Nomor Resi Pengembalian</th>
                                                    <th>Periode Sewa Tanggal</th>
                                                    <th>Dikembalikan Tanggal</th>
                                                    <th>Denda Keterlambatan</th>
                                                    <th>Total Harga + Denda</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($order as $ord)
                                                    <tr>
                                                        <td data-title="#" class="align-middle">
                                                            {{ $loop->iteration }}</td>
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
                                                        <td data-title="Additional" class="align-middle text-opacity-75">
                                                            @if ($ord->additional)
                                                                <ul>
                                                                    @foreach ($ord->additional as $add)
                                                                        <li>{{ $add['nama'] }} +
                                                                            {{ number_format($add['harga'], 0, '', '.') }}
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            @else
                                                                <div class="text-opacity-25">-</div>
                                                            @endif
                                                            @if ($ord->id_produk_order->biaya_cuci)
                                                                <ul>
                                                                    <li>Biaya cuci +
                                                                        {{ number_format($ord->id_produk_order->biaya_cuci, 0, '', '.') }}
                                                                    </li>
                                                                </ul>
                                                            @endif
                                                        </td>
                                                        <td data-title="Nomor Resi" class="align-middle">
                                                            {{ $ord->nomor_resi }}
                                                        </td>
                                                        <td data-title="Periode Sewa" class="align-middle">
                                                            {{ $ord->tanggalFormatted($ord->tanggal_mulai) }} <span
                                                                class="fw-bolder"> s.d. </span>
                                                            {{ $ord->tanggalFormatted($ord->tanggal_selesai) }}
                                                        </td>
                                                        <td data-title="Dikembalikan" class="align-middle">
                                                            {{ $ord->tanggalFormatted($ord->tanggal_pengembalian) }}
                                                        </td>
                                                        <td data-title="Denda Keterlambatan" class="align-middle">
                                                            {{ number_format($ord->denda_keterlambatan, 0, '', '.') }}
                                                        </td>
                                                        <td data-title="Total + Denda" class="align-middle">
                                                            {{ number_format($ord->total_harga, 0, '', '.') }}</td>
                                                        <td data-title="aksi" class="align-middle">
                                                            <a data-bs-toggle="modal"
                                                                data-bs-target="#selesaikanPenyewaan-1"
                                                                class="d-grid btn btn-success mb-2"
                                                                id="konfirmasi">Konfirmasi
                                                                Selesai</a>
                                                            <a href="" class="d-grid btn btn-outline-success mb-2"
                                                                id="chat">Chat</a>
                                                            <a data-bs-toggle="modal"
                                                                class="d-grid btn btn-outline-danger mb-2"
                                                                data-bs-target="#ajukanDendaSewa-1" id="denda">Ajukan
                                                                Denda</a>
                                                        </td>
                                                    </tr>
                                                    <!-- Modal Konfirmasi Sewa -->
                                                    <div class="modal fade" id="selesaikanPenyewaan-1" tabindex="-1"
                                                        aria-labelledby="inputResi-1Label" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <form
                                                                action="{{ route('seller.view.penilaian.TambahReviewPenyewa', ['id' => $ord->id_penyewa, 'nomor_order' => $ord->nomor_order]) }}"
                                                                method="POST">
                                                                @csrf
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title fs-5"
                                                                            id="inputResi-1Label">Konfirmasi Selesai</h1>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p for="exampleFormControlInput1"
                                                                            class="form-label">Nomor Order :
                                                                            {{ $ord->nomor_order }}</p>
                                                                        <p for="exampleFormControlInput1"
                                                                            class="form-label">Produk :
                                                                            {{ $ord->id_produk_order->nama_produk }}
                                                                        </p>
                                                                        <small class="fw-light mb-3" href=""
                                                                            style="font-size:14px">{{ $ord->id_produk_order->brand }},
                                                                            Ukuran
                                                                            {{ $ord->id_produk_order->ukuran_produk }}</small>
                                                                        <hr>
                                                                        <p> Anda akan diarahkan untuk mengisi review
                                                                            penyewa. Setelah anda
                                                                            menambahkan review dan penyewaan
                                                                            selesai, status produk akan menjadi "arsip".
                                                                            <span class="fw-bold text-danger">Mohon
                                                                                aktifkan
                                                                                Produk secara manual pada
                                                                                menu produk </span> agar bisa disewa kembali
                                                                            ketika sudah ready.
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
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Denda Sewa -->
                    <form action="" method="POST">
                        <div class="modal fade" id="ajukanDendaSewa-1" tabindex="-1" aria-labelledby="inputResi-1Label"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="inputResi-1Label">Ajukan Denda Sewa</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="m-2">
                                            <label for="exampleFormControlInput1" class="form-label">Nama
                                                Peraturan<span class="text-danger mb-3">*</span></label>
                                            <select class="form-select" aria-label="Default select example" required>
                                                <option selected>Pilih Peraturan yang dilanggar</option>
                                                <option value="Jaring Wig Hilang">Jaring Wig Hilang</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                            </select>
                                        </div>
                                        <div class="m-2">
                                            <label for="hargaInput" class="form-label">Nominal Denda<span
                                                    class="text-danger mb-3">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text" id="span_nominal">Rp.</span>
                                                <input type="number" id="hargaInput" class="form-control"
                                                    name="nominal_denda" placeholder="50000" aria-label="Denda"
                                                    pattern="[0-9]*">
                                            </div>
                                        </div>
                                        <div class="m-2">
                                            <label for="textArea" class="form-label">Penjelasan<span
                                                    class="text-danger mb-3">*</span></label>
                                            <textarea class="form-control" id="textArea" rows="3"></textarea>
                                        </div>
                                        <div class="m-2">
                                            <label for="formFileSm" class="form-label">Bukti<span
                                                    class="text-danger mb-3">*</span></label>
                                            <input class="form-control form-control-sm" id="formFileSm" type="file"
                                                accept=".jpg,.png,.jpeg,.webp" id="fotoInput-0" required>
                                        </div>
                                        <p class="m-2 mt-3">Setelah submit pengajuan denda, button "ajukan denda sewa" ini
                                            akan
                                            berubah
                                            menjadi "detail". Anda dapat melihat detail hasil pengajuan sewa dengan button
                                            tersebut
                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-kalasewa">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
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
