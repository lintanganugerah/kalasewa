@extends('admin.layout.app')

@section('title', 'Detail Pengguna')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Pengguna</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.verify.index') }}">Verifikasi User</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $user->nama }}</li>
        </ol>
    </div>

    <div class="card mb-5">
        <div class="card-body">
            <div class="text-left mb-4">
                <img id="userFotoProfil"
                    src="{{ $user->foto_profil ? asset($user->foto_diri) : asset('default-profile.png') }}"
                    alt="Foto Profil" class="img-thumbnail" style="max-width: 150px;">
            </div>
            <div class="text-left mt-4">
                <img id="userIdentitas" src="{{ $user->foto_identitas ? asset($user->foto_identitas) : 'FOTO NULL' }}"
                    alt="Identitas" class="img-thumbnail">
            </div>
            <ul class="list-group">
                <li class="list-group-item"><strong>NIK:</strong> {{ $user->NIK }}</li>
                <li class="list-group-item"><strong>Nama:</strong> {{ $user->nama }}</li>
                <li class="list-group-item"><strong>Email:</strong> {{ $user->email }}</li>
                <li class="list-group-item"><strong>Nomor Telpon:</strong> {{ $user->no_telp }}</li>
                @if ($user->no_darurat)
                    <li class="list-group-item">
                        <strong>Nomor Telpon Darurat:</strong> {{ $user->no_darurat }}
                    </li>
                @endif
                <li class="list-group-item"><strong>Alamat :</strong> {{ $user->alamat }}</li>
                <li class="list-group-item"><strong>Kode Pos :</strong> {{ $user->kode_pos }}</li>
                <li class="list-group-item"><strong>Kota/Kabupaten :</strong> {{ $user->kota }}</li>
                <li class="list-group-item"><strong>Provinsi :</strong> {{ $user->provinsi }}</li>
                <li class="list-group-item"><strong>Role:</strong>
                    {{ $user->role === 'penyewa' ? 'Penyewa' : 'Pemilik Sewa' }}</li>
                <li class="list-group-item"><strong>Verifikasi Identitas:</strong> {{ $user->verifyIdentitas }}</li>
            </ul>
            <div class="mt-4">
                <form action="{{ route('admin.users.updateVerification', $user->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="action" value="verify">
                    <button type="submit" class="btn btn-success">Verifikasi</button>
                </form>
                <form action="{{ route('admin.users.updateVerification', $user->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="action" value="reject">
                    <!-- Tambahkan input tersembunyi untuk aksi "Tolak" -->
                    <button type="submit" class="btn btn-danger">Tolak</button>
                </form>
            </div>
        </div>
    </div>

@endsection
