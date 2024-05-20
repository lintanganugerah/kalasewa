@extends('layout.template')
@extends('layout.navbar')

@section('content')

<link rel="stylesheet" type="text/css" href="{{ asset('css/userprofile.css') }}">

<div class="profile-container">
    <div class="row2">
        <div class="card text-bg-dark border-primary">
            <h5 class="card-header">Ganti Password</h5>
            <div class="card-body">
                <div class="profileform">
                    <p>Password Lama</p>
                    <input type="password" name="password" id="password" class="userform form-control" placeholder="Password">
                    <p>Password Baru</p>
                    <input type="password" name="newPassword" id="newPassword" class="userform form-control" placeholder="Password Baru" minlength="8" required>
                    <p>Konfirmasi Password Baru</p>
                    <input type="password" name="confNewPassword" id="confNewPassword" class="userform form-control" placeholder="Konfirmasi Password Baru" minlength="8" required>
                    <button class="btn btn-outline-success">
                        Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
