@extends('admin.layout.app')

@section('title', 'Dashboard')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Create Series</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Manajemen Series</li>
        <li class="breadcrumb-item active" aria-current="page">Create Series</li>
    </ol>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.series.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="series">Nama Series</label>
                <input type="text" class="form-control" id="series" name="series" required>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
            <a href="{{ route('admin.series.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>  
</div>

@endsection
