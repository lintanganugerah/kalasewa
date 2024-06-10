<?php

use App\Http\Controllers\AutentikasiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Admin Dashboard Route
Route::middleware('admin',)->group(function () {
    Route::get('/admin/dashboard', [UserController::class, 'userCount'])->name('admin.dashboard');

    // Series Routes
    Route::resource('admin/series', SeriesController::class);
    Route::get('/admin/series/{series}/edit', [SeriesController::class, 'edit'])->name('admin.series.edit');
    Route::put('/admin/series/{series}', [SeriesController::class, 'update'])->name('admin.series.update');
    Route::delete('/admin/series/{series}', [SeriesController::class, 'destroy'])->name('admin.series.destroy');
    Route::get('/admin/series/create', [SeriesController::class, 'create'])->name('admin.series.create');
    Route::get('/admin/series', [SeriesController::class, 'index'])->name('admin.series.index');
    Route::post('/admin/series', [SeriesController::class, 'store'])->name('admin.series.store');

    // Role Routes
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');

    // Verify Routes
    Route::get('/admin/verify', [UserController::class, 'index_verify'])->name('admin.verify.index');
    Route::put('/admin/users/{user}/verify', [UserController::class, 'updateVerification'])->name('admin.users.updateVerification');
    Route::get('/admin/users/{user}', [UserController::class, 'show'])->name('admin.users.show');
});

// Series Search
Route::get('/admin/series/search', [SeriesController::class, 'search']);
    

// Series Setting
// Route::get('/admin/series', [AdminController::class, 'series'])
//     ->name('admin.series')
//     ->middleware('auth');

// Route::resource('/admin/series', SeriesController::class);

// Route::get('/admin/series/{series}/edit', [SeriesController::class, 'edit'])
//     ->name('admin.series.edit');

// Route::delete('/admin/series/{series}', [SeriesController::class, 'destroy'])
//     ->name('admin.series.destroy');

// Route::put('/admin/series/{id}', [SeriesController::class, 'update'])->name('admin.series.update');

// Route::get('/admin/series', [SeriesController::class, 'index'])->name('admin.series.index');

// Error 404
Route::get('/admin/404', function () {
    return view('admin.404');
});

Route::get('/login', [AutentikasiController::class, 'loginView'])->name('loginView');

Route::post('/login/act', [AutentikasiController::class, 'loginAction'])->name('loginAction');
Route::get('/logout', [AutentikasiController::class, 'logout'])->name('logout');

Route::get('/forgot-password', [AutentikasiController::class,'viewForgotPass'])->name('viewForgotPass');

Route::post('/forgot-password', [AutentikasiController::class,'ForgotPassAction'])->name('ForgotPassAction');

Route::get('/reset-password/{token}', [AutentikasiController::class,'viewresetPass'])->name('password.reset');

Route::post('/reset-password', [AutentikasiController::class,'resetPassAction'])->name('resetPassAction');

Route::get('/daftar/seller', [AutentikasiController::class, 'registerView'])->name('seller.registerView');
Route::get('/daftar/buyer', [AutentikasiController::class, 'registerViewBuyer'])->name('buyer.registerViewBuyer');
