@extends('admin.layout.app')

@section('title', 'Dashboard')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Manajemen Series</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Manajemen Series</li>
    </ol>
</div>

<!-- <form action="/admin/series/search" class="form-inline" method="GET">
    <input type="search" name="search" class="form-control" placehsolder="Cari Series">
    <div class="input-group-append">
        <button type="submit" class="btn btn-default">
            <i class="fas fa-search"></i>
        </button>
    </div>
</form> -->

<div class="mb-3">
    <a href="{{ route('admin.series.create') }}" class="btn btn-primary">Tambah Series</a>
</div>

<div class="table-responsive">
    <table class="table table-bordered" id="series-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Series</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody id="series-table">
            @foreach ($series as $seriesItem)
            <tr>
                <td>{{ $seriesItem->id }}</td>
                <td>{{ $seriesItem->series }}</td>
                <td>
                    <!-- Tombol Edit -->
                    <a href="{{ route('admin.series.edit', $seriesItem->id) }}" class="btn btn-warning">Edit</a>
                </td>
                <td>
                    <!-- Tombol Delete -->
                    <form action="{{ route('admin.series.destroy', $seriesItem->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus series ini?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
