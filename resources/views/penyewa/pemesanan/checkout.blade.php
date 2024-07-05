@extends('layout.template')

@section('content')
<section>
    <div class="container-fluid mt-5">
        <div class="container">
            <div class="col text-center">
                <h1><strong>Checkout Pesanan Kamu!</strong></h1>
            </div>
        </div>
    </div>

    <div class="container mt-2 mb-3">
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

    <div class="container-fluid mt-5">
        <div class="container">
            <div class="card">
                <div class="card-body w-100">
                    @if($checkout->isNotEmpty())
                    @foreach($checkout as $item)
                    <div class="row">
                        <div class="col-2">
                            <img src="{{ asset($item->produk->fotoProduk->path) }}" alt="Catalog" class="img-thumbnail">
                        </div>
                        <div class="col-8">
                            <h3><strong>{{ $item->produk->nama_produk }}</strong></h3>
                            <p>Size : {{ $item->ukuran }}</p>
                            <p>Additional:
                                @if(!empty($item->additional))
                                @foreach($item->additional as $additionalItem)
                                {{ $additionalItem['nama'] }}
                                @endforeach
                                @endif
                            </p>
                            <p>Status: <span class="text-danger">{{ $item->status }}</span></p>
                        </div>
                        <div class="col-2 row text-end align-self-end">
                            <h2><strong>Rp{{ number_format($item->grand_total, 0, '', '.') }}</strong></h2>
                            <button id="pay-button" class="btn btn-danger">Checkout</button>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <p class="text-center">Kamu sedang tidak ada proses checkout!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@if ($checkout->isNotEmpty())
@foreach ($checkout as $item)
@section('scripts')

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
<script type="text/javascript">
document.getElementById('pay-button').onclick = function() {
    // SnapToken acquired from previous step
    snap.pay('{{ $item->snapToken }}', {
        // Optional
        onSuccess: function(result) {
            // AJAX call to update status
            $.ajax({
                url: '{{ route("updateCheckout") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    nomor_order: '{{ $item->nomor_order }}'
                },
                success: function(response) {
                    if (response.success) {
                        window.location.href = response.redirect_url;
                    } else {
                        alert(
                            'Pembayaran berhasil, tetapi gagal memperbarui status pesanan.');
                    }
                },
                error: function() {
                    alert(
                        'Pembayaran berhasil, tetapi terjadi kesalahan saat memperbarui status pesanan.'
                    );
                }
            });
        },
        // Optional
        onPending: function(result) {
            /* You may add your own js here, this is just example */
            document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
        },
        // Optional
        onError: function(result) {
            /* You may add your own js here, this is just example */
            document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
        }
    });
};
</script>

@endsection
@endforeach
@endif