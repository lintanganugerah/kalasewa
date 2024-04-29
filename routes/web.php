<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login-seller');
});

Route::get('/daftar', function () {
    return view('daftar-seller');
});

Route::get('/daftar/verifikasi', function () {
    return view('daftar-kode-verifikasi');
});

Route::get('/daftar/informasiseller', function () {
    return view('daftar-informasi-seller');
});
Route::get('/test', function () {
    return view('test');
});
Route::get('/beranda', function () {
    return view('beranda');
});