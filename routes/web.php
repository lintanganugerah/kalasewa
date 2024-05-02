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

Route::get('/daftar/informasi', [AutentikasiSellerController::class, 'registerInformationView'])->name('seller.registerInformationView');

Route::post('/daftar/informasi/act', [AutentikasiSellerController::class, 'registerInformationAction'])->name('seller.registerInformationAction');

Route::get('/daftar/informasiseller', function () {
    return view('daftar-informasi-seller');
});
Route::get('/test', function () {
    return view('test');
});

Route::get('/beranda', [SellerController::class, 'sellerBerandaView'])->name('seller.berandaView');

Route::get('/pesanan/perluproses', function () {
    return view('pesanan.perluproses');
});

Route::get('/produk/tambahproduk', [ProdukSellerController::class, 'viewTambahProduk'])->name('viewTambahProduk');