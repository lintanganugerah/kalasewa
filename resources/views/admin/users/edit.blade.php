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
                        <!-- Common fields for all roles -->
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                value="{{ $user->nama }}" @if ($user->role !== 'admin') readonly @endif>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ $user->email }}" @if ($user->role !== 'admin') readonly @endif>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" name="password"
                                    @if ($user->role !== 'admin') value="{{ $user->password }}" readonly 
                                @else
                                    placeholder="Masukkan Password Baru" @endif>
                                @if ($user->role === 'admin')
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-outline-secondary" id="toggle-password"
                                            onclick="togglePassword()">
                                            <i class="fas fa-eye" id="toggle-icon"></i>
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="no_telp">No. Telepon</label>
                            <input type="text" class="form-control" id="no_telp" name="no_telp"
                                value="{{ $user->no_telp }}" @if ($user->role !== 'admin') readonly @endif>
                        </div>
                        <div class="form-group">
                            <label for="role">Role</label>
                            <input type="text" class="form-control" id="role" name="role"
                                value="{{ ['admin' => 'Admin', 'penyewa' => 'Penyewa', 'pemilik_sewa' => 'Pemilik Sewa'][$user->role] ?? $user->role }}"
                                required readonly>
                        </div>
                        <div class="form-group">
                            <label for="verifyIdentitas">Verifikasi Identitas</label>
                            <input type="text" class="form-control" id="verifyIdentitas" name="verifyIdentitas"
                                value="{{ $user->verifyIdentitas }}" readonly>
                        </div>
                        @if ($user->role !== 'admin')
                            <div class="form-group">
                                <label for="no_darurat">No. Darurat</label>
                                <input type="text" class="form-control" id="no_darurat" name="no_darurat"
                                    value="{{ $user->no_darurat }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="badge">Badge</label>
                                <input type="text" class="form-control" id="badge" name="badge"
                                    value="{{ $user->badge }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="link_sosial_media">Link Sosial Media</label>
                                <a href="{{ $user->link_sosial_media }}"
                                    target="_blank">{{ $user->link_sosial_media }}</a>
                            </div>
                        @endif
                    </div>

                    <!-- Identitas User (hanya ditampilkan jika role bukan admin) -->
                    @if ($user->role !== 'admin')
                        <div class="col-md-6">
                            <h4>Identitas User</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="foto_profil">Foto Profil</label>
                                        @if ($user->foto_profil)
                                            <img src="{{ asset($user->foto_profil) }}" alt="Foto Profil"
                                                class="mt-2 d-block" width="150">
                                        @else
                                            <i class="fas fa-portrait fa-10x mt-2 d-block"></i>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="foto_diri">Foto Diri</label>
                                        @if ($user->foto_diri)
                                            <img src="{{ asset($user->foto_diri) }}" alt="Foto Diri" class="mt-2 d-block"
                                                width="150">
                                        @else
                                            <i class="fas fa-portrait fa-10x mt-2 d-block"></i>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="identitas">Identitas</label>
                                        @if ($user->foto_identitas)
                                            <img src="{{ asset($user->foto_identitas) }}" alt="Foto Identitas"
                                                class="mt-2 d-block" width="250">
                                            <a href="{{ asset($user->foto_identitas) }}" class="mt-2">Lihat
                                                Identitas</a>
                                        @else
                                            <i class="fas fa-id-card fa-10x mt-2 d-block"></i>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="NIK">NIK</label>
                                <input type="text" class="form-control" id="NIK" name="NIK"
                                    value="{{ $user->NIK }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="text" class="form-control" id="alamat" name="alamat"
                                    value="{{ $user->alamat }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="provinsi">Provinsi</label>
                                <input type="text" class="form-control" id="provinsi" name="provinsi"
                                    value="{{ $user->provinsi }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="kota">Kota</label>
                                <input type="text" class="form-control" id="kota" name="kota"
                                    value="{{ $user->kota }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="kode_pos">Kode Pos</label>
                                <input type="text" class="form-control" id="kode_pos" name="kode_pos"
                                    value="{{ $user->kode_pos }}" readonly>
                            </div>
                        </div>
                    @endif
                </div>

                @if ($user->role === 'admin')
                    <button type="submit" class="btn btn-primary btn-block mb-2">Update</button>
                @endif
            </form>

            <!-- Tombol Delete -->
            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger delete-btn btn-block mb-2"
                    onclick="return confirmDelete()">Delete</button>
            </form>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary btn-block">Batal</a>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggle-icon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>

@endsection

@section('scripts')
    <script>
        function confirmDelete() {
            return confirm('Apakah Anda yakin ingin menghapus user ini?');
        }
    </script>
@endsection
