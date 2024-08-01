@extends('layout.template')
@extends('layout.navbar')

@section('content')

<section>

    <div class="container-fluid mt-5">
        <div class="container text-center">
            <h1><strong>INFORMASI PEMESANAN</strong></h1>
        </div>
    </div>

    <div class="container mt-2 mb-3">
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
        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
    </div>

    <div class="container-fluid mt-5">
        <div class="container">
            <form action="{{ route('createOrder', ['id' => $produk->id]) }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-3">

                        @foreach ($fotoproduk->where('id_produk', $produk->id)->take(1) as $foto)
                        <img src="{{ asset($foto->path) }}" class="img-thumbnail" alt="fotoproduk">
                        @endforeach

                    </div>
                    <div class="col-6">


                        <h1><strong>{{ $produk->nama_produk }}</strong></h1>

                        @if ($produk->additional)
                        <h3><strong>Pilih Additional</strong></h3>
                        @foreach (json_decode($produk->additional, true) as $nama => $harga)
                        <input type="checkbox" class="btn-check additional-check"
                            id="btn-check-additional-{{ $loop->index }}" name="additional[]" value="{{ $nama }}"
                            data-nama="{{ $nama }}" data-harga="{{ $harga }}" autocomplete="off">
                        <label class="btn btn-outline-dark"
                            for="btn-check-additional-{{ $loop->index }}">{{ $nama }}</label>
                        <p class="harga-additional-value" hidden>Rp0</p> <!-- Tambahkan kelas unik di sini -->
                        @endforeach
                        <div id="emailHelp" class="form-text">Silahkan pilih additional yang tersedia (opsional)
                        </div>
                        @endif

                        <div class="datepckr d-flex mt-3">
                            <div class="col mx-1">
                                <label for="exampleInputEmail1" class="form-label">Tanggal Mulai<span
                                        class="text-danger">*</span></label>
                                <input type="date" id="mulaisewa" name="mulaisewa" placeholder="Tanggal Mulai Sewa"
                                    class="form-control form-control-lg w-100" required />
                                <div id="emailHelp" class="form-text">Silahkan pilih tanggal mulai sewa anda!</div>
                            </div>
                            <div class="col mx-1">
                                <label for="exampleInputEmail1" class="form-label">Tanggal Selesai<span
                                        class="text-danger">*</span></label>
                                <input type="date" id="akhirsewa" name="akhirsewa" placeholder="Tanggal Akhir Sewa"
                                    class="form-control form-control-lg w-100" required readonly />
                                <div id="emailHelp" class="form-text">Sistem akan otomatis memilih hari akhir sewa!
                                    (durasi 3 hari)</div>
                            </div>
                        </div>

                        <div class="sizeproduk-ctner mt-3" hidden>
                            <label for="exampleInputEmail1" class="form-label">Ukuran<span
                                    class="text-danger">*</span></label>
                            <input type="text" name="size" placeholder="Ukuran Produk"
                                class="form-control form-control-lg w-100" value="{{ $produk->ukuran_produk }}" />
                            <div id="emailHelp" class="form-text">Ukuran Produk yang Dipilih</div>
                        </div>

                        <div class="namapenyewa-ctner mt-3">
                            <label for="exampleInputEmail1" class="form-label">Nama Penyewa<span
                                    class="text-danger">*</span></label>
                            <input type="text" name="nama" placeholder="Nama Penyewa"
                                class="form-control form-control-lg w-100" value="{{ auth()->user()->nama }}"
                                required />
                            <div id="emailHelp" class="form-text">Masukkan nama anda</div>
                        </div>

                        <div class="alamat-ctner mt-3">
                            <label for="exampleInputEmail1" class="form-label">Alamat Penyewa<span
                                    class="text-danger">*</span></label>
                            <textarea name="alamat" placeholder="Alamat Penyewa"
                                class="form-control form-control-lg w-100"
                                required>{{ auth()->user()->alamat }}</textarea>
                            <div id="emailHelp" class="form-text">Pastikan alamat anda diisi dengan lengkap dan detail
                                untuk memudahkan pengiriman!</div>
                        </div>

                        <div class="metodekirim-ctner mt-3">
                            <label class="form-label">Metode Pengiriman<span class="text-danger">*</span></label><br>
                            <select name="metodekirim" class="form-select" aria-label="Default select example">
                                @foreach (json_decode($produk->metode_kirim, true) as $ekspedisi)
                                <option value="{{ $ekspedisi }}">{{ $ekspedisi }}</option>
                                @endforeach
                            </select>
                            <div id="emailHelp" class="form-text">Silahkan pilih metode pengiriman dari toko yang
                                tersedia!</div>
                        </div>

                        <input type="hidden" id="additional-items" name="additional_items">


                    </div>
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
                                        <p class="text-secondary">Jaminan Ongkir<span class="text-danger">*</span></p>
                                    </div>
                                    <div class="col text-end">
                                        <p class="text-secondary" id="harga-katalog">
                                            Rp{{ number_format($produk->harga, 0, '', '.') }}</p>
                                        <p class="text-secondary" id="harga-additional-total">Rp0</p>
                                        @if ($produk->biaya_cuci)
                                        <p class="text-secondary" id="harga-cuci">
                                            Rp{{ number_format($produk->biaya_cuci, 0, '', '.') }}</p>
                                        @else
                                        <p class="text-secondary" id="harga-cuci">
                                            Rp{{ number_format(0) }}</p>
                                        @endif
                                        <p class="text-secondary" id="ongkos-kirim">
                                            Rp{{ number_format(30000, 0, '', '.') }}</p>
                                    </div>
                                </div>
                                <p class="mt-2"><strong>Biaya Transaksi</strong></p>
                                <div class="d-flex">
                                    <div class="col text-start">
                                        <p class="text-secondary">Jaminan Katalog<span class="text-danger">*</span></p>
                                        <p class="text-secondary" id="biaya-admin-label">Biaya Admin</p>
                                    </div>
                                    <div class="col text-end">
                                        <p class="text-secondary">Rp50.000</p>
                                        <p class="text-secondary" id="biaya-admin-value">Rp0</p>
                                    </div>
                                </div>
                                <h5 class="mt-2"><strong>Total Tagihan</strong></h5>
                                <h4><strong id="total-tagihan">Rp0</strong>
                                </h4>
                                <hr>
                                <p class="text-secondary">(<span class="text-danger">*</span>) Jaminan akan dikembalikan
                                    kepada penyewa jika
                                    masih ada sisa!</p>

                                <button type="submit" class="btn btn-danger w-100 mt-2">BAYAR</button>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>

    @include('layout.footer')

</section>

<script>
document.addEventListener('DOMContentLoaded', (event) => {
    const hargaKatalogElement = document.getElementById('harga-katalog');
    const hargaAdditionalLabels = document.querySelectorAll('#harga-additional-label');
    const hargaAdditionalValues = document.querySelectorAll('.harga-additional-value');
    const biayaAdminElement = document.getElementById('biaya-admin-value');
    const hargaCuciValues = document.getElementById('harga-cuci');
    const hargaOngkosKirim = document.getElementById('ongkos-kirim');
    const totalTagihanElement = document.getElementById('total-tagihan');
    const additionalCheckboxes = document.querySelectorAll('.additional-check');

    const updateCosts = () => {
        let hargaKatalog = parseInt(hargaKatalogElement.textContent.replace('Rp', '').replace(/\./g,
            ''));
        let hargaCuci = parseInt(hargaCuciValues.textContent.replace('Rp', '').replace(/\./g, ''));
        let ongkosKirim = parseInt(hargaOngkosKirim.textContent.replace('Rp', '').replace(/\./g, ''));
        let totalHargaAdditional = 0;
        let additionalItems = [];

        additionalCheckboxes.forEach((checkbox, index) => {
            if (checkbox.checked) {
                let namaAdditional = checkbox.getAttribute('data-nama');
                let hargaAdditional = parseInt(checkbox.getAttribute('data-harga'));
                totalHargaAdditional += hargaAdditional;
                additionalItems.push({
                    nama: namaAdditional,
                    harga: hargaAdditional
                });
            }
        });

        document.getElementById('harga-additional-total').textContent =
            `Rp${totalHargaAdditional.toLocaleString('id-ID')}`;

        let biayaAdmin = (hargaKatalog + totalHargaAdditional) * 0.05;
        biayaAdminElement.textContent = `Rp${biayaAdmin.toLocaleString('id-ID')}`;

        let totalTagihan = hargaKatalog + totalHargaAdditional + biayaAdmin + hargaCuci + ongkosKirim +
            50000; // 50000 adalah Biaya Jaminan tetap
        totalTagihanElement.textContent = `Rp${totalTagihan.toLocaleString('id-ID')}`;

        // Simpan additionalItems ke dalam hidden input untuk dikirimkan ke server
        document.getElementById('additional-items').value = JSON.stringify(additionalItems);
    };

    additionalCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateCosts);
    });

    updateCosts();
});
</script>

<!-- <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            // Mengambil elemen yang dibutuhkan
            const hargaKatalogElement = document.getElementById('harga-katalog');
            const hargaAdditionalLabels = document.querySelectorAll('#harga-additional-label');
            const hargaAdditionalValues = document.querySelectorAll('.harga-additional-value');
            const biayaAdminElement = document.getElementById('biaya-admin-value');
            const hargaCuciValues = document.getElementById('harga-cuci');
            const totalTagihanElement = document.getElementById('total-tagihan');
            const additionalCheckboxes = document.querySelectorAll('.additional-check');

            // Fungsi untuk memperbarui biaya admin dan total tagihan
            const updateCosts = () => {
                let hargaKatalog = parseInt(hargaKatalogElement.textContent.replace('Rp', '').replace(/\./g,
                    ''));
                let hargaCuci = parseInt(hargaCuciValues.textContent.replace('Rp', '').replace(/\./g, ''));
                let totalHargaAdditional = 0;

                additionalCheckboxes.forEach((checkbox, index) => {
                    if (checkbox.checked) {
                        let hargaAdditional = parseInt(checkbox.getAttribute('data-harga'));
                        hargaAdditionalValues[index].textContent =
                            `Rp${hargaAdditional.toLocaleString('id-ID')}`;
                        totalHargaAdditional += hargaAdditional;
                    } else {
                        hargaAdditionalValues[index].textContent = `Rp0`;
                    }
                });

                // Menghitung total harga additional yang aktif
                let hargaAdditionalTotal = totalHargaAdditional;
                document.getElementById('harga-additional-total').textContent =
                    `Rp${hargaAdditionalTotal.toLocaleString('id-ID')}`;

                let biayaAdmin = (hargaKatalog + totalHargaAdditional) * 0.05;
                biayaAdminElement.textContent = `Rp${biayaAdmin.toLocaleString('id-ID')}`;

                let totalTagihan = hargaKatalog + totalHargaAdditional + biayaAdmin + hargaCuci +
                    50000; // 50000 adalah Biaya Jaminan tetap
                totalTagihanElement.textContent = `Rp${totalTagihan.toLocaleString('id-ID')}`;
            };

            // Menambahkan event listener ke checkbox additional
            additionalCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateCosts);
            });

            // Inisialisasi pertama kali
            updateCosts();

            // Menambahkan event listener ke checkbox additional
            additionalCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateCosts);
            });
        });
    </script> -->

<script>
document.addEventListener('DOMContentLoaded', function() {
    var today = new Date();
    var yyyy = today.getFullYear();
    var mm = String(today.getMonth() + 1).padStart(2, '0'); // Months are zero-based
    var dd = String(today.getDate()).padStart(2, '0');

    // Calculate minDate (H+2)
    var minDate = new Date(today);
    minDate.setDate(today.getDate() + 2);
    var minyyyy = minDate.getFullYear();
    var minmm = String(minDate.getMonth() + 1).padStart(2, '0');
    var mindd = String(minDate.getDate()).padStart(2, '0');
    var minDateString = minyyyy + '-' + minmm + '-' + mindd;

    // Calculate maxDate (H+7)
    var maxDate = new Date(today);
    maxDate.setDate(today.getDate() + 7);
    var maxyyyy = maxDate.getFullYear();
    var maxmm = String(maxDate.getMonth() + 1).padStart(2, '0');
    var maxdd = String(maxDate.getDate()).padStart(2, '0');
    var maxDateString = maxyyyy + '-' + maxmm + '-' + maxdd;

    var mulaisewaInput = document.getElementById('mulaisewa');
    var akhirsewaInput = document.getElementById('akhirsewa');

    mulaisewaInput.setAttribute('min', minDateString);
    mulaisewaInput.setAttribute('max', maxDateString);

    mulaisewaInput.addEventListener('change', function() {
        var selectedDate = new Date(this.value);
        var akhirDate = new Date(selectedDate);
        akhirDate.setDate(selectedDate.getDate() + 2);
        var akhiryyyy = akhirDate.getFullYear();
        var akhirmm = String(akhirDate.getMonth() + 1).padStart(2, '0');
        var akhirdd = String(akhirDate.getDate()).padStart(2, '0');
        var akhirDateString = akhiryyyy + '-' + akhirmm + '-' + akhirdd;

        akhirsewaInput.value = akhirDateString;
    });
});
</script>

@endsection