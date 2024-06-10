@extends('layout.template')
@section('content')

<link rel="stylesheet" type="text/css" href="{{ asset('css/authentication.css') }}">

<div class="container mt-5 pt-5">
    <div class="row">
        <div class="col-12 col-sm-8 col-md-6 m-auto">
            <div class="card border-1 shadow text-bg-dark">
                <div class="login-card card-body text-center">
                    <form action="#" method="POST">
                        @csrf
                        <img src="{{ asset('images/kalasewa.png') }}" alt="Kalasewa Logo" width="100" height="100">
                        <h1>KALASEWA</h1>
                        <p>Silahkan login terlebih dahulu!</p>
                        <input type="text" name="username" id="username" class="email form-control my-4 py-2" placeholder="Email">
                        <input type="password" name="password" id="password" class="password form-control my-4 py-2" placeholder="Password">
                        <div class="text-center mt-3">
                            <button class="btn btn-outline-success">
                                Login
                            </button>
                            <a href="" class="nav-link mt-3">Lupa password?</a>
                            <a href="" class="nav-link mt-3">Belum punya akun? Yuk daftar!</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection