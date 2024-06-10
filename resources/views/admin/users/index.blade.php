@extends('admin.layout.app')

@section('title', 'Manajemen User')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Manajemen User</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Manajemen User</li>
    </ol>
</div>

<div class="table-responsive">
    <h2 class="h4 text-gray-800">Users</h2>
    <!-- Tambah User Button -->
    <div class="mb-4">
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Tambah User</a>
    </div>
    <table class="table table-bordered" id="users-table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>No. Telepon</th>
                <th>Role</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                @if ($user->role !== 'admin' && $user->verifyIdentitas !== 'Ditolak')
                    <tr>
                        <td>{{ $user->nama }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->no_telp }}</td>
                        <td>
                            @if ($user->role === 'penyewa')
                                Penyewa
                            @elseif ($user->role === 'pemilik_sewa')
                                Pemilik Sewa
                            @endif
                        </td>
                        <td style="width: 10%;">
                            <!-- Tombol Edit -->
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-block">Edit</a>
                        </td>
                        <td style="width: 10%;">
                            <!-- Tombol Delete -->
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger delete-btn btn-block" onclick="return confirmDelete()">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>

<div class="table-responsive">
    <h2 class="h4 mt-4 mb-4 text-gray-800">Admin</h2>
    <table class="table table-bordered" id="admin-users-table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                @if ($user->role === 'admin' && $user->verifyIdentitas !== 'Ditolak')
                    <tr>
                        <td>{{ $user->nama }}</td>
                        <td>{{ $user->email }}</td>
                        <td style="width: 10%;">
                            <!-- Tombol Edit -->
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-block">Edit</a>
                        </td>
                        <td style="width: 10%;">
                            <!-- Tombol Delete -->
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger delete-btn btn-block" onclick="return confirmDelete()">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>

<script>
    function confirmDelete() {
        return confirm('Apakah Anda yakin ingin menghapus user ini?');
    }
</script>

@endsection
