@extends('layout-seller.selllayout')
@section('content')

<div class="row">
  <div class="col">
    <div class="text-left mb-5 mt-3">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Produk</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tambah Produk</li>
      </ol>
      <h1 class="fw-bold text-secondary">PRODUK</h1>
      <h4 class="fw-semibold text-secondary">Tambahkan Produk Anda</h4>
    </div>

    <div class="row gx-5">
    
      <div class="card-body shadow">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <h4 class="text-dark fw-bold mb-3">INFORMASI PRODUK</h4>
            <h5 class="text-dark fw-semibold">Tambahkan foto Produk</h5>
          </div>
          <div class="col mr-2">
            <h4 class="text-dark fw-bold mb-3">INFORMASI PRODUK</h4>
            <h5 class="text-dark fw-semibold">Tambahkan foto Produk</h5>
          </div>
        </div>
      </div>

    <div class="text-white p-4 rounded-3 mb-4 mt-4" style="background-color: #0D3148;">
      <h4 id="judul-tabel-1" class="mb-3">Permintaan Pinjam</h4>
      <table id="tabel" class="no-more-tables table text-dark table-sm table-light w-100 tabel-data" style="word-wrap: break-word;" cellspacing="0">
        <thead>
          <tr>
            <th>#</th>
            <th>No Rek</th>
            <th>Nama</th>
            <th>CIF</th>
            <th>Lokasi Berkas</th>
            <th>Jenis</th>
            <th>User</th>
            <th>Lemari</th>
            <th>Rak</th>
            <th>Baris</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
    </div>
  </div>
    
<script>
  $(document).ready(function() {
    const date = new Date();
    $('.tabel-data').DataTable({
      lengthMenu: [
        [3, 5, 10, 25, -1],
        [3, 5, 10, 25, 'All']
      ],
      // fixedHeader: true,
      // order: [
      //   [6, 'asc']
      // ],
      // rowGroup: {
      //   dataSrc: 6
      // }
    });
    $('#downloadable').DataTable({
      lengthMenu: [
        [3, 5, 10, 25, -1],
        [3, 5, 10, 25, 'All']
      ],
      dom: 'Bfrtip',
      buttons: [{
          extend: 'excel',
          text: 'Excel',
          title: "Berkas sedang dipinjam",
          messageTop: date,
          messageBottom: "Jika berkas sudah tidak digunakan lagi. Mohon kembalikan berkas melalui menu 'Pengembalian'",
          filename: "Berkas sedang dipinjam"
        },
        {
          extend: 'pdf',
          text: 'PDF',
          title: "Berkas sedang dipinjam",
          messageTop: date,
          messageBottom: "Jika berkas sudah tidak digunakan lagi. Mohon mengembalikan berkas melalui menu 'Pengembalian'",
          filename: "Berkas sedang dipinjam"
        },
        {
          extend: 'print',
          text: 'Print',
          title: "Berkas sedang dipinjam",
          messageTop: date,
          messageBottom: "Jika berkas sudah tidak digunakan lagi. Mohon mengembalikan berkas melalui menu 'Pengembalian'",
          filename: "Berkas sedang dipinjam"
        }, 'pageLength',
      ]
    });
  });
</script>
@endsection