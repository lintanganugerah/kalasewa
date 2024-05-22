@extends('layout.template')
@extends('layout.navbar')

@section('content')

<link rel="stylesheet" type="text/css" href="{{ asset('css/userprofile.css') }}">

<div class="profile-container">
    <div class="row2">
        <div class="card text-bg-dark border-primary">
            <h5 class="card-header">Pengaturan Profil</h5>
            <div class="card-body">
                <div class="profilepicture">
                    <img src="{{ asset('images/profile.png') }}" alt="User Profile">
                    <div class="d-grid gap-2">
                        <label class="form-label btn btn-outline-primary mb-0" for="BtnProfileImage">Ganti Foto</label>
                        <input type="file" name="photo" accept="image/*" class="form-control d-none" id="BtnProfileImage" onchange="displaySelectedImage(event, 'profileImage')">
                    </div>
                </div>
                <div class="profileform">
                    <p>Username</p>
                    <input type="text" name="username" id="username" class="userform form-control" placeholder="Username">
                    <p>Email</p>
                    <input type="email" name="email" id="email" class="userform form-control" placeholder="Email">
                    <p>Nomor HP</p>
                    <input type="number" name="phonenumber" id="phonenumber" class="userform form-control" placeholder="Nomor HP" required>
                    <p>NIK (akan diverifikasi)</p>
                    <input type="number" name="address" id="address" class="userform form-control" placeholder="Nomor Induk Kependudukan (NIK)" required>
                    <p>Alamat</p>
                    <input type="text" name="address" id="address" class="userform form-control" placeholder="Alamat Lengkap" required>
                    <p>Provinsi</p>
                    <input type="text" name="province" id="province" class="userform form-control" placeholder="Provinsi" required>
                    <p>Kota</p>
                    <input type="text" name="city" id="city" class="userform form-control" placeholder="Kota" required>
                    <p>Kode POS</p>
                    <input type="text" name="postalcode" id="postalcode" class="userform form-control" placeholder="Kode POS" required>
                    <button class="btn btn-outline-success">
                        Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


