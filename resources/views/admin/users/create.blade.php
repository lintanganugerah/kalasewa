@extends('admin.layout.app')

@section('title', 'Tambah User')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah User</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Manajemen User</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tambah User</li>
    </ol>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="no_telp">No. Telepon</label>
                <input type="text" class="form-control" id="no_telp" name="no_telp">
            </div>
            <!-- <div class="form-group">
                <label for="badge">Badge</label>
                <input type="text" class="form-control" id="badge" name="badge">
            </div> -->
            <div class="form-group">
                <label for="role">Role</label>
                <select class="form-control" id="role" name="role" required>
                    <option value="penyewa">Penyewa</option>
                    <option value="pemilik_sewa">Pemilik Sewa</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div class="form-group">
                <label for="verifyIdentitas">Verifikasi Identitas</label>
                <select class="form-control" id="verifyIdentitas" name="verifyIdentitas" required>
                    <option value="Sudah">Sudah</option>
                    <option value="Tidak" selected>Tidak</option>
                    <option value="Ditolak">Ditolak</option>
                </select>
            </div>
            <div class="form-group">
                <label for="foto_profil">Foto Profil</label>
                <input type="file" class="form-control-file" id="foto_profil" name="foto_profil">
            </div>
            <div class="form-group">
                <label for="identitas">Identitas</label>
                <input type="file" class="form-control-file" id="identitas" name="identitas">
            </div>
            <div class="form-group">
                <label for="NIK">NIK</label>
                <input type="text" class="form-control" id="NIK" name="NIK">
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat">
            </div>
            <div class="form-group">
                <label for="provinsi">Provinsi</label>
                <input type="text" class="form-control" id="provinsi" name="provinsi">
            </div>
            <div class="form-group">
                <label for="kota">Kota</label>
                <input type="text" class="form-control" id="kota" name="kota">
            </div>
            <div class="form-group">
                <label for="kode_pos">Kode Pos</label>
                <input type="text" class="form-control" id="kode_pos" name="kode_pos">
            </div>
            <button type="submit" class="btn btn-primary">Tambah User</button>
        </form>
    </div>
</div>

@endsection
