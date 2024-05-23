<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukSellerController;
use App\Http\Controllers\AutentikasiSellerController;
use App\Http\Controllers\SellerController;

Route::get('/login', [AutentikasiSellerController::class, 'loginView'])->name('seller.loginView');

Route::post('/login/act', [AutentikasiSellerController::class, 'loginAction'])->name('seller.loginAction');

Route::get('/daftar/seller', [AutentikasiSellerController::class, 'registerView'])->name('seller.registerView');
Route::get('/daftar/buyer', [AutentikasiSellerController::class, 'registerViewBuyer'])->name('buyer.registerViewBuyer');

Route::post('/daftar/act/seller', [AutentikasiSellerController::class, 'checkEmailSeller'])->name('seller.registerAction');

Route::post('/daftar/act/buyer', [AutentikasiSellerController::class, 'checkEmailBuyer'])->name('buyer.registerAction');

Route::get('/daftar/seller/informasi', [AutentikasiSellerController::class,'registerInformationView'])->name('seller.registerInformationView');

Route::post('/daftar/seller/informasi/act', [AutentikasiSellerController::class,'registerInformationActionSeller'])->name('seller.registerInformationActionSeller');
Route::post('/daftar/seller/resend/informasi/act', [AutentikasiSellerController::class,'uploadUlangRegisterInformationSeller'])->name('seller.uploadUlangRegisterInformation');

Route::get('/resend/verify', [AutentikasiSellerController::class, 'resendVerify'])->name('seller.resendVerify');

Route::get('/daftar/verifikasi', [AutentikasiSellerController::class, 'verifikasiView'])->name('seller.verifikasiView');
Route::get('/daftar/verified', [AutentikasiSellerController::class, 'verifiedView'])->name('seller.verifiedView');

Route::get('/email/verify/{id}/{hash}', [AutentikasiSellerController::class, 'verify'])->name('verification.verify');


Route::group(['middleware' => 'pemilik_sewa'], function () {

    Route::get('/daftar/identitas', [SellerController::class,'regisIdentitasView'])->name('seller.regisIdentitasView');
    
    Route::post('/daftar/identitas/act', [SellerController::class,'identitasAction'])->name('seller.identitasAction');
    
    Route::get('/beranda', [SellerController::class, 'sellerBerandaView'])->name('seller.berandaView');
    
    Route::get('/profil/toko', [SellerController::class, 'profilTokoView'])->name('seller.profilTokoView');

    Route::post('/profil/toko/act', [SellerController::class, 'profilTokoAction'])->name('seller.profilTokoAction');
    
    Route::get('/pesanan/perluproses', function () {
        return view('pesanan.perluproses');
    });  

    Route::get('/produk/tambahproduk', [ProdukSellerController::class, 'viewTambahProduk'])->name('seller.viewTambahProduk');

    Route::post('/produk/tambahproduk/act', [ProdukSellerController::class, 'tambahProdukAction'])->name('seller.tambahProdukAction');

    Route::get('/logout', [AutentikasiSellerController::class, 'logout'])->name('seller.logout');
});
