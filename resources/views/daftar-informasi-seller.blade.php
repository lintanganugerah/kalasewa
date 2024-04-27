@extends('layout-seller.layout-seller')
@section('content')
@include('layout-seller.navbar')


<section class="vh-100">
    <div class="container py-5 h-100">
        <div class="mb-3 pb-1">
            <span class="h1 fw-bold mb-0">Mohon isi informasi toko anda</span>
        </div>
        <div class="card" style="border-radius: 1rem;">
            <div class="row">

                <div class="d-md-block align-items-center">
                    <div class="card-body p-4 p-lg-5 text-black">

                        <form>
                            <h5 class="fw-bold mb-3 pb-3" style="letter-spacing: 1px;">Informasi Toko
                            </h5>

                            <div data-mdb-input-init class="form-outline mb-4">
                                <label class="form-label" for="form2Example17">Nama Toko</label>
                                <input type="email" id="form2Example17" class="form-control form-control-lg" />
                            </div>

                            <div data-mdb-input-init class="form-outline mb-4">
                                <label class="form-label" for="form2Example27">Alamat Toko</label>
                                <textarea type="text" id="form2Example27"
                                    class="form-control form-control-lg"> </textarea>
                            </div>

                            <div class="form-floating mb-4">
                                <select class="form-select" id="floatingSelect" name="provinsi"
                                    aria-label="Floating label select example">
                                    <option selected> </option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                                <label for="floatingSelect">Provinsi</label>
                            </div>

                            <div class="form-floating mb-4">
                                <select class="form-select" id="floatingSelect" name="kota"
                                    aria-label="Floating label select example">
                                    <option selected> </option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                                <label for="floatingSelect">Kota</label>
                            </div>

                            <div class="form-floating mb-4">
                                <select class="form-select" id="floatingSelect" name="kabupaten"
                                    aria-label="Floating label select example">
                                    <option selected> </option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                                <label for="floatingSelect">Kabupaten</label>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <div data-mdb-input-init class="form-outline">
                                        <label class="form-label" for="form3Example1">First name</label>
                                        <input type="text" id="form3Example1" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div data-mdb-input-init class="form-outline">
                                        <label class="form-label" for="form3Example2">Kode Pos</label>
                                        <input type="text" id="form3Example2" class="form-control" />
                                    </div>
                                </div>
                            </div>

                            <div class="pt-1 mb-4">
                                <button data-mdb-button-init data-mdb-ripple-init
                                    class="btn btn-kalasewa btn-lg btn-block" type="button">Login</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection