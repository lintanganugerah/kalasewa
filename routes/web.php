<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukSellerController;
use App\Http\Controllers\AutentikasiSellerController;
use App\Http\Controllers\SellerController;

Route::get('/login', [AutentikasiSellerController::class, 'loginView'])->name('seller.loginView');

Route::post('/login/act', [AutentikasiSellerController::class, 'loginAction'])->name('seller.loginAction');

Route::get('/daftar', [AutentikasiSellerController::class, 'registerView'])->name('seller.registerView');

Route::post('/daftar/act', [AutentikasiSellerController::class, 'registerFirstStage'])->name('seller.registerAction');

Route::get('/daftar/verifikasi', [AutentikasiSellerController::class, 'verifikasiView'])->name('seller.verifikasiView');

Route::get('/email/verify/{id}/{hash}', [AutentikasiSellerController::class, 'verify'])->name('verification.verify');


Route::group(['middleware' => 'pemilik_sewa'], function () {
    Route::get('/daftar/informasi', [AutentikasiSellerController::class, 'registerInformationView'])->name('seller.registerInformationView');
    
    Route::post('/daftar/informasi/act', [AutentikasiSellerController::class, 'registerInformationAction'])->name('seller.registerInformationAction');

    Route::get('/beranda', [SellerController::class, 'sellerBerandaView'])->name('seller.berandaView');
    
    Route::get('/profil/toko', [SellerController::class, 'profilTokoView'])->name('seller.profilTokoView');
    
    Route::get('/pesanan/perluproses', function () {
        return view('pesanan.perluproses');
    });

    Route::get('/produk/tambahproduk', [ProdukSellerController::class, 'viewTambahProduk'])->name('viewTambahProduk');

    Route::get('/logout', [AutentikasiSellerController::class, 'logout'])->name('seller.logout');
});
