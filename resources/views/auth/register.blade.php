@extends('layout.template')
@section('content')

<div class="container mt-5 pt-5">
    <div class="row">
        <div class="col-12 col-sm-8 col-md-6 m-auto">
            <div class="card border-1 shadow text-bg-dark">
                <div class="login-card card-body text-center">
                    <form action="#" method="POST" onsubmit="return validateForm()">
                        @csrf
                        <img src="{{ asset('images/kalasewa.png') }}" alt="Kalasewa Logo" width="100" height="100">
                        <h1>KALASEWA</h1>

                        <!-- DISPLAY ERROR -->
                        @error('username')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                        @error('email')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                        @error('password')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                        @error('confPassword')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror

                        <p>Ayo bergabung bersama Kalasewa!</p>
                        <input type="text" name="username" id="username" class="email form-control my-4 py-2" placeholder="Username" required>
                        <input type="email" name="email" id="email" class="email form-control my-4 py-2" placeholder="Email" required>
                        <input type="password" name="password" id="password" class="password form-control my-4 py-2" placeholder="Password" minlength="8" required>
                        <input type="password" name="confPassword" id="confPassword" class="password form-control my-4 py-2" placeholder="Confirm Password" minlength="8" required>
                        <div class="form-check text-left mt-3">
                            <input type="checkbox" class="form-check-input" id="terms" required>
                            <label class="form-check-label" for="terms">
                                Dengan ini saya menyetujui <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal">Syarat & Ketentuan</a> Kalasewa
                            </label>
                        </div>
                        <div class="text-center mt-3">
                            <button class="btn btn-outline-success">
                                Daftar
                            </button>
                            <a href="" class="nav-link mt-3">Sudah punya akun? Login!</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content text-bg-dark">
      <div class="modal-header">
        <h5 class="modal-title" id="termsModalLabel">Syarat & Ketentuan</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Your terms and conditions content goes here -->
        <p>Isi dari syarat dan ketentuan...</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
    function validateForm() {
        var password = document.getElementById("password").value;
        var confPassword = document.getElementById("confPassword").value;

        if (password !== confPassword) {
            alert("Passwords do not match");
            return false;
        }

        return true;
    }
</script>

@endsection