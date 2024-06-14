@extends('admin.layout.app')

@section('title', 'Tambah User')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Admin</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Manajemen User</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Admin</li>
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
                <div class="form-group">
                    <label for="role">Role</label>
                    <input type="text" class="form-control" id="role" name="role" value="admin" readonly>
                </div>
                <div class="form-group">
                    <label for="verifyIdentitas">Verifikasi Identitas</label>
                    <input type="text" class="form-control" id="verifyIdentitas" name="verifyIdentitas" value="Sudah"
                        readonly>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Tambah User</button>
            </form>
        </div>
    </div>

@endsection
