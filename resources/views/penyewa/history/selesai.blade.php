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
                <h1><strong>Udah Rental Apa Aja Nih?</strong></h1>
            </div>
        </div>
    </div>

    <div class="button-content mt-5">
        <div class="container-fluid">
            <div class="container">
                <a href="{{route('viewHistory')}}" class="no-underline">
                    <button type="button" class="btn btn-outline-danger">Semua</button>
                </a>
                <a href="{{route('viewHistoryOngoing')}}" class="no-underline">
                    <button type="button" class="btn btn-outline-danger">Sedang
                        Berlangsung</button>
                </a>
                <a href="{{route('viewHistoryFinish')}}" class="no-underline">
                    <button type="button" class="btn btn-danger">Selesai</button>
                </a>
            </div>
        </div>
    </div>

    <div class="table-content mt-5">
        <div class="container-fluid">
            <div class="container">
                @if ($orders)
                <table id="table-history">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nomor Order</th>
                            <th>Nama Produk</th>
                            <th>Ukuran</th>
                            <th>Additional</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Metode Kirim</th>
                            <th>Total Biaya</th>
                            <th>Bukti Resi</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                        @if ($order->status == "Penyewaan Selesai")
                        <tr>
                            <td data-title="#" class="align-middle">
                                {{ $loop->iteration }}
                            </td>
                            <td>{{ $order->nomor_order }}</td>
                            <td>{{ $order->nama_produk }}</td>
                            <td>{{ $order->ukuran }}</td>
                            <td>
                                @if (!empty($order->additional) && is_array($order->additional))
                                @foreach ($order->additional as $additionalItem)
                                @if (is_array($additionalItem) && isset($additionalItem['nama']))
                                {{ $additionalItem['nama'] }}
                                @endif
                                @endforeach
                                @endif
                            </td>
                            <td>{{ $order->tanggal_mulai }}</td>
                            <td>{{ $order->tanggal_selesai }}</td>
                            <td>{{ $order->metode_kirim }}</td>
                            <td>Rp{{ number_format($order->grand_total, 0, '', '.') }}</td>
                            @if ($order->bukti_resi)
                            <td><img class="img-thumbnail" src="{{ asset($order->bukti_resi) }}" alt="Produk"
                                    style="width: 100px; height: 100px; object-fit: cover; cursor: pointer;"
                                    data-bs-toggle="modal" data-bs-target="#resiModal-{{ $loop->iteration }}"></td>
                            @else
                            <td>
                                <p>-</p>
                            </td>
                            @endif
                            <td>{{ $order->status }}</td>
                            <td>
                                @if ($order->status == "Pending")
                                <a class="btn btn-outline-danger w-100 mb-2"
                                    href="{{ route('viewDetailPemesanan', ['orderId' => $order->nomor_order]) }}">Detail</a>
                                @elseif ($order->status == "Dalam Pengiriman")
                                <a class="btn btn-outline-danger w-100 mb-2"
                                    href="{{ route('viewDetailPemesanan', ['orderId' => $order->nomor_order]) }}">Detail</a>
                                @elseif ($order->status == "Sedang Berlangsung")
                                <a class="btn btn-outline-danger w-100 mb-2"
                                    href="{{ route('viewPengembalianBarang', ['orderId' => $order->nomor_order]) }}">Detail</a>
                                @elseif ($order->status == "Telah Kembali" or $order->status == "Penyewaan Selesai")
                                <a class="btn btn-outline-danger w-100 mb-2"
                                    href="{{ route('viewPenyewaanSelesai', ['orderId' => $order->nomor_order]) }}">Detail</a>
                                @elseif ($order->status == "Dibatalkan Pemilik Sewa")
                                <a class="btn btn-outline-danger w-100 mb-2"
                                    href="{{ route('viewDibatalkanPemilikSewa', ['orderId' => $order->nomor_order]) }}">Detail</a>
                                @else
                                <button class="btn btn-outline-danger w-100 mb-2" disabled>Detail</button>
                                @endif
                                <a class="btn btn-danger w-100 mb-2" href="">Cetak</a>
                            </td>
                        </tr>

                        <!-- Modal for Bukti Resi -->
                        <div class="modal fade" id="resiModal-{{ $loop->iteration }}" tabindex="-1"
                            aria-labelledby="resiModalLabel-{{ $loop->iteration }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="resiModalLabel-{{ $loop->iteration }}">Bukti
                                            Resi</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <img src="{{ asset($order->bukti_resi) }}" alt="Bukti Resi" class="img-fluid">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>
    </div>

    @include('layout.footer')

</section>

@endsection