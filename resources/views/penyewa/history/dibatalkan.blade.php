@extends('layout.template')
@extends('layout.navbar')

@section('content')

<style>
.no-underline {
    text-decoration: none;
    /* Remove underline */
    color: inherit;
    /* Inherit the color from the parent element or set it explicitly */
}
</style>

<section>

    <div class="header-text-content mt-5 text-center">
        <div class="container-fluid">
            <div class="container">
                <h1><strong>History Penyewaan</strong></h1>
            </div>
        </div>
    </div>

    <div class="container mt-2">
        @csrf
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

    </div>

    <div class="button-content mt-5">
        <div class="container-fluid">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs" id="historyTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link text-secondary"
                                    href="{{route('viewHistoryMenungguDiproses')}}">Menunggu Konfirmasi
                                    @if ($countMenungguDiproses)
                                    <span class="position-top badge rounded-pill bg-danger">
                                        {{$countMenungguDiproses}}
                                    </span>
                                    @endif

                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-secondary" href="{{route('viewHistoryDalamPengiriman')}}">Dalam
                                    Pengiriman @if ($countDalamPengiriman)
                                    <span class="position-top badge rounded-pill bg-danger">
                                        {{$countDalamPengiriman}}
                                    </span>
                                    @endif

                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-secondary"
                                    href="{{route('viewHistorySedangBerlangsung')}}">Sedang
                                    Digunakan @if ($countSedangBerlangsung)
                                    <span class="position-top badge rounded-pill bg-danger">
                                        {{$countSedangBerlangsung}}
                                    </span>
                                    @endif

                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-secondary" href="{{route('viewHistoryTelahKembali')}}">Dikirim
                                    Kembali @if ($countTelahKembali)
                                    <span class="position-top badge rounded-pill bg-danger">
                                        {{$countTelahKembali}}
                                    </span>
                                    @endif

                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page"
                                    href="{{route('viewHistoryDibatalkan')}}">Dibatalkan @if ($countDibatalkan)
                                    <span class="position-top badge rounded-pill bg-danger">
                                        {{$countDibatalkan}}
                                    </span>
                                    @endif

                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-secondary" href="{{route('viewHistoryDiretur')}}">Diretur
                                    @if ($countDiretur)
                                    <span class="position-top badge rounded-pill bg-danger">
                                        {{$countDiretur}}
                                    </span>
                                    @endif


                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-secondary"
                                    href="{{route('viewHistoryPenyewaanSelesai')}}">Penyewaan
                                    Selesai</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-secondary" href="{{route('viewHistory')}}">Semua</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            @if($orders)
                            <table class="table w-100" id="table-history">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nomor Order</th>
                                        <th>Nama Produk</th>
                                        <th>Additional</th>
                                        <th>Tanggal Mulai</th>
                                        <th>Tanggal Selesai</th>
                                        <th>Total Biaya</th>
                                        <th>Alasan Pembatalan</th>
                                        <th>Status</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                    <tr>
                                        <td data-title="#" class="text-center">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>{{ $order->nomor_order }}</td>
                                        <td>{{ $order->nama_produk }}</td>
                                        <td>
                                            @if (!empty($order->additional) && is_array($order->additional))
                                            @foreach ($order->additional as $additionalItem)
                                            @if (is_array($additionalItem) && isset($additionalItem['nama']))
                                            {{ $additionalItem['nama'] }}
                                            @endif
                                            @endforeach
                                            @else
                                            <p>-</p>
                                            @endif

                                        </td>
                                        <td>{{ $order->tanggal_mulai }}</td>
                                        <td>{{ $order->tanggal_selesai }}</td>
                                        <td>Rp{{ number_format($order->grand_total, 0, '', '.') }}</td>
                                        <td class="text-danger">{{$order->alasan_pembatalan}}</td>
                                        <td>{{ $order->status }}</td>
                                        <td>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#refundModal-{{ $loop->iteration }}">
                                                Ajukan Refund
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Modal for Resi -->
                                    <div class="modal fade" id="refundModal-{{ $loop->iteration }}" tabindex="-1"
                                        aria-labelledby="refundModalLabel-{{ $loop->iteration }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5"
                                                        id="refundModalLabel-{{ $loop->iteration }}">
                                                        Ajukan Refund</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Bukti Penerimaan Barang<span class="text-danger">*</span></p>
                                                    <input type="file" name="foto" class="form-control mb-2"
                                                        id="userPhoto" accept=".jpg,.png,.jpeg,.webp" required>
                                                    <div id="password" class="form-text">Silahkan kirimkan bukti
                                                        ketidaksesuaian barang yang diterima!</div>


                                                    <p class="mt-2">Deskripsi<span class="text-danger">*</span></p>
                                                    <textarea type="text" id="alamat"
                                                        class="form-control form-control-lg" name="alamat"
                                                        required></textarea>
                                                    <div id="password" class="form-text">Jelaskan deskripsi kerusakan
                                                        secara rinci pada bagian ini. Ini akan memudahkan anda untuk
                                                        memproses pengajuan refund.</div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @endforeach
                                </tbody>
                            </table>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layout.footer')

</section>

@endsection