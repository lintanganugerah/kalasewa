@extends('layout-seller.layout-seller')
@section('content')
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="mb-3 pb-1">
                <span class="h1 fw-bold mb-0">Reset Password</span>
            </div>
            <div class="card" style="border-radius: 1rem;">
                <div class="row">

                    <div class="d-md-block align-items-center">
                        <div class="card-body p-4 p-lg-5 text-black">

                            <form action="{{ route('resetPassAction') }}" method="POST">
                                @csrf
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        {{ $errors->first() }}
                                    </div>
                                @endif
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <input type="hidden" name="token" value="{{ $token }}">
                                <input type="hidden" name="email" value="{{ $email }}">
                                <h5 class="fw-bold mb-3 pb-3" style="letter-spacing: 1px;">Input Password Baru
                                </h5>
                                <div data-mdb-input-init class="form-outline mb-4">
                                    <label class="form-label" for="form2Example17">Password</label>
                                    <input type="password" id="form2Example17" class="form-control form-control-lg"
                                        name="password" minlength="8" required />
                                </div>
                                <div data-mdb-input-init class="form-outline mb-4">
                                    <label class="form-label" for="form2Example17">Konfirmasi Password</label>
                                    <input type="password" id="form2Example17" class="form-control form-control-lg"
                                        name="password_confirmation" minlength="8" required />
                                </div>

                                <div class="d-grid mb-5">
                                    <button data-mdb-button-init data-mdb-ripple-init
                                        class="btn btn-kalasewa btn-lg btn-block" type="submit">Reset Password</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('seller/inputangka.js') }}"></script>
    </section>
@endsection
