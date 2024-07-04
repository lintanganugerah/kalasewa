@extends('layout.template')
@extends('layout.navbar')

@section('content')

<section>

    <div class="container-fluid mt-5">
        <div class="container text-center">
            <h1><strong>INFORMASI PEMESANAN</strong></h1>
        </div>
    </div>

    <div class="container mt-2">
        @csrf
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
    </div>

    <div class="container-fluid mt-5">
        <div class="container">
            <div class="row">
                <div class="col-3">

                    <img src="{{ asset($order->foto_produk) }}" class="img-thumbnail" alt="fotoproduk">

                </div>
                <div class="col-6">

                    <form action="">

                        <h1><strong>{{ $order->nama_produk }}</strong></h1>

                        <h3><strong>Informasi Pilihan Kostum</strong></h3>
                        @if (!empty($order->additional) && is_array($order->additional))
                        @foreach ($order->additional as $additionalItem)
                        @if (is_array($additionalItem) && isset($additionalItem['nama']))
                        <button class="btn btn-outline-dark" type="button">{{$additionalItem['nama']}}</button>
                        @endif
                        @endforeach
                        @endif
                        <button class="btn btn-outline-dark" type="button">{{$order->ukuran}}</button>
                        <div id="emailHelp" class="form-text">Berikut adalah pilihan additional dan ukuran yang kamu
                            pilih</div>

                        <div class="datepckr d-flex mt-3">
                            <div class="col mx-1">
                                <label for="exampleInputEmail1" class="form-label">Tanggal Mulai</label>
                                <input type="text" name="infomulai" placeholder="Tanggal Mulai Sewa"
                                    class="form-control form-control-lg w-100" value="{{$order->tanggal_mulai}}"
                                    readonly />
                                <div id="emailHelp" class="form-text">Tanggal mulai sewa anda!</div>
                            </div>
                            <div class="col mx-1">
                                <label for="exampleInputEmail1" class="form-label">Tanggal Selesai</label>
                                <input type="text" name="infoselesai" placeholder="Tanggal Akhir Sewa"
                                    class="form-control form-control-lg w-100" value="{{$order->tanggal_selesai}}"
                                    readonly />
                                <div id="emailHelp" class="form-text">Tanggal akhir sewa anda! (3 hari penyewaan)</div>
                            </div>
                        </div>

                        <div class="namapenyewa-ctner mt-3">
                            <label for="exampleInputEmail1" class="form-label">Nama Penyewa</label>
                            <input type="text" name="nama" placeholder="Nama Penyewa"
                                class="form-control form-control-lg w-100" value="{{ $order->nama_penyewa }}"
                                readonly />
                            <div id="emailHelp" class="form-text">Nama yang terdaftar sebagai penyewa</div>
                        </div>

                        <div class="alamat-ctner mt-3">
                            <label for="exampleInputEmail1" class="form-label">Alamat Penyewa<span
                                    class="text-danger">*</span></label>
                            <textarea name="alamat" placeholder="Alamat Penyewa"
                                class="form-control form-control-lg w-100"
                                readonly>{{ $order->tujuan_pengiriman }}</textarea>
                            <div id="emailHelp" class="form-text">Pastikan alamat anda diisi dengan lengkap dan detail
                                untuk memudahkan pengiriman!</div>
                        </div>

                        <div class="metodekirim-ctner mt-3">
                            <label for="exampleInputEmail1" class="form-label">Nama Penyewa</label>
                            <input type="text" name="metodekirim" placeholder="Metode Kirim"
                                class="form-control form-control-lg w-100" value="{{ $order->metode_kirim }}"
                                readonly />
                            <div id="emailHelp" class="form-text">Metode kirim yang dipilih</div>
                        </div>

                        <div class="noresi-ctner mt-3">
                            <label for="exampleInputEmail1" class="form-label">Nomor Resi</label>
                            <input type="text" name="nomorresi" placeholder="Nomor Resi"
                                class="form-control form-control-lg w-100" value="{{ $order->nomor_resi }}" readonly />
                            <div id="emailHelp" class="form-text">Nomor resi pengiriman untuk pelacakan. klik <span><a
                                        href="https://www.cekresi.com" target="_blank">disini</a></span> untuk mengecek
                                resi</div>
                        </div>
                </div>

                </form>

                <div class="col-3">

                    <div class="card">
                        <div class="card-body">
                            <h5><strong>Ringkasan Belanja</strong></h5>
                            <p><strong>Total Barang</strong></p>
                            <div class="d-flex">
                                <div class="col text-start">
                                    <p class="text-secondary">Harga Katalog</p>
                                    <p class="text-secondary" id="harga-additional-label">Harga Additional</p>
                                    <p class="text-secondary">Harga Cuci</p>
                                </div>
                                <div class="col text-end">
                                    <p class="text-secondary" id="harga-katalog">
                                        Rp{{ number_format($order->total_harga, 0, '', '.') }}</p>

                                    @if ($order->additional)
                                    @foreach ($order->additional as $additionalItem)
                                    <p class="text-secondary" id="harga-additional-total">
                                        Rp{{ number_format($additionalItem['harga'], 0, '', '.') }}</p>
                                    @endforeach
                                    @endif

                                    <p class="text-secondary" id="harga-cuci">
                                        Rp{{ number_format($order->biaya_cuci ?? 0, 0, '', '.') }}</p>
                                </div>
                            </div>
                            <p class="mt-2"><strong>Biaya Transaksi</strong></p>
                            <div class="d-flex">
                                <div class="col text-start">
                                    <p class="text-secondary">Biaya Jaminan</p>
                                    <p class="text-secondary" id="biaya-admin-label">Biaya Admin</p>
                                </div>
                                <div class="col text-end">
                                    <p class="text-secondary">Rp50.000</p>
                                    <p class="text-secondary" id="biaya-admin-value">
                                        Rp{{ number_format($order->fee_admin, 0, '', '.') }}</p>
                                </div>
                            </div>
                            <h5 class="mt-2"><strong>Total Tagihan</strong></h5>
                            <h4><strong
                                    id="total-tagihan">Rp{{ number_format($order->total_tagihan, 0, '', '.') }}</strong>
                            </h4>
                        </div>

                    </div>

                    <div class="choice-cntr mt-2">
                        <a class="btn btn-danger w-100 mb-2" href="#" role="button" data-bs-toggle="modal"
                            data-bs-target="#receivedModal">Barang Diterima</a>
                        <a class="btn btn-outline-danger w-100" href="#" role="button" data-bs-toggle="modal"
                            data-bs-target="#refundModal">Pengajuan Refund</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>

    @include('layout.footer')

    <!-- Modal Diterima -->
    <div class="modal fade" id="receivedModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Bukti Barang Diterima</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('terimaBarang', ['orderId' => $order->nomor_order])}}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <label for="formFile" class="form-label">Bukti Barang Diterima<span
                                class="text-danger">*</span></label>
                        <input class="form-control" type="file" id="formFile" name="bukti_diterima"
                            accept=".jpg,.png,.jpeg,.webp" required>
                        <div id="emailHelp" class="form-text text-danger">Pastikan gambar yang dikirim mencakup seluruh
                            barang yang diterima!</div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Refund -->
    <div class="modal fade" id="refundModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Pengajuan Refund</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('viewHistory')}}">
                    <div class="modal-body">
                        <div class="deskripsi-bukti">
                            <label for="formFile" class="form-label">Deskripsi Ketidaksesuaian<span
                                    class="text-danger">*</span></label>
                            <textarea name="deskripsi_bukti" placeholder="Deskripsi Ketidaksesuaian"
                                class="form-control form-control-lg w-100" required></textarea>
                            <div id="emailHelp" class="form-text text-danger">Tuliskan deskripsi ketidaksesuaian
                                sedetail mungkin!</div>
                        </div>
                        <div class="file-bukti mt-3">
                            <label for="formFile" class="form-label">Bukti Ketidaksesuaian<span
                                    class="text-danger">*</span></label>
                            <input class="form-control" type="file" id="formFile" required>
                            <div id="emailHelp" class="form-text text-danger">Gambar yang dikirim akan dijadikan bukti
                                untuk pengajuan refund!</div>
                        </div>
                        <div class="nomor-resi mt-3">
                            <label for="exampleInputEmail1" class="form-label">Nomor Resi<span
                                    class="text-danger">*</span></label>
                            <input type="text" name="nomorresi" placeholder="Nomor Resi"
                                class="form-control form-control-lg w-100" />
                            <div id="emailHelp" class="form-text">Nomor resi pengiriman untuk pelacakan</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</section>

@endsection