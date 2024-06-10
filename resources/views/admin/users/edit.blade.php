@extends('admin.layout.app')

@section('title', 'Edit User')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit User</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Manajemen User</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit User</li>
    </ol>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <!-- Informasi User -->
                <div class="col-md-6">
                    <h4>Informasi User</h4>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ $user->nama }}" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required readonly>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" value="{{ $user->password }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="no_telp">No. Telepon</label>
                        <input type="text" class="form-control" id="no_telp" name="no_telp" value="{{ $user->no_telp }}">
                    </div>
                    <div class="form-group">
                        <label for="badge">Badge</label>
                        <input type="text" class="form-control" id="badge" name="badge" value="{{ $user->badge }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select class="form-control" id="role" name="role" required>
                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="penyewa" {{ $user->role == 'penyewa' ? 'selected' : '' }}>Penyewa</option>
                            <option value="pemilik_sewa" {{ $user->role == 'pemilik_sewa' ? 'selected' : '' }}>Pemilik Sewa</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="verifyIdentitas">Verifikasi Identitas</label>
                        <input type="text" class="form-control @if($user->verifyIdentitas == 'Sudah') is-valid @elseif($user->verifyIdentitas == 'Tidak') is-invalid @endif" id="verifyIdentitas" name="verifyIdentitas" value="{{ $user->verifyIdentitas }}" readonly>
                        @if($user->verifyIdentitas == 'Tidak')
                        <div class="invalid-feedback">
                            Verifikasi Identitas Belum Dilakukan.
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Identitas User -->
                    <div class="col-md-6">
                        <h4>Identitas User</h4>
                        <div class="form-group">
                        <label for="foto_profil">Foto Profil</label>
                        <input type="file" class="form-control-file" id="foto_profil" name="foto_profil">
                        @if ($user->foto_profil)
                            <img src="{{ asset('storage/foto_profil/' . $user->foto_profil) }}" alt="Foto Profil" class="mt-2" width="150">
                        @else
                            <i class="fas fa-image fa-10x mt-2"></i>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="identitas">Identitas</label>
                        <input type="file" class="form-control-file" id="identitas" name="identitas">
                        @if ($user->identitas)
                        <a href="{{ asset('storage/' . $user->identitas) }}" class="mt-2">Lihat Identitas</a>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="NIK">NIK</label>
                        <input type="text" class="form-control" id="NIK" name="NIK" value="{{ $user->NIK }}">
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $user->alamat }}">
                    </div>
                    <div class="form-group">
                        <label for="provinsi">Provinsi</label>
                        <input type="text" class="form-control" id="provinsi" name="provinsi" value="{{ $user->provinsi }}">
                    </div>
                    <div class="form-group">
                        <label for="kota">Kota</label>
                        <input type="text" class="form-control" id="kota" name="kota" value="{{ $user->kota }}">
                    </div>
                    <div class="form-group">
                        <label for="kode_pos">Kode Pos</label>
                        <input type="text" class="form-control" id="kode_pos" name="kode_pos" value="{{ $user->kode_pos }}">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>  
</div>

@endsection
