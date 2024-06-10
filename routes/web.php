<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AutentikasiBuyerController;
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\WishlistController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/user/profile', function () {
    return view('user/profile');
});

Route::get('/user/password', function () {
    return view('user/changepassword');
});

Route::get('/login', [AutentikasiBuyerController::class, 'loginView'])->name('loginView');

Route::post('/login/act', [AutentikasiBuyerController::class, 'loginAction'])->name('loginAction');

Route::get('/daftar/seller', [AutentikasiBuyerController::class, 'registerView'])->name('seller.registerView');
Route::get('/daftar/buyer', [AutentikasiBuyerController::class, 'registerViewBuyer'])->name('buyer.registerViewBuyer');

Route::post('/daftar/act/buyer', [AutentikasiBuyerController::class, 'registerActionBuyer'])->name('buyer.registerAction'); 
Route::get('/daftar/informasi', [AutentikasiBuyerController::class, 'registerInformationView'])->name('buyer.registerInformationView'); 
Route::post('/daftar/informasi/act', [AutentikasiBuyerController::class, 'registerInformationAction'])->name('buyer.registerInformationAction'); 

Route::get('/daftar/verifikasi', [AutentikasiBuyerController::class, 'verifikasiView'])->name('buyer.verifikasiView');
Route::get('/daftar/verified', [AutentikasiBuyerController::class, 'verifiedView'])->name('buyer.verifiedView');
Route::get('/resend/verify', [AutentikasiBuyerController::class, 'resendVerify'])->name('buyer.resendVerify');

Route::get('/email/verify/{id}/{hash}', [AutentikasiBuyerController::class, 'verify'])->name('verification.verify'); 

Route::get('/search', [CatalogController::class, 'search'])->name('search');

Route::get('/logout', [AutentikasiBuyerController::class, 'logout'])->name('userLogout'); 

Route::get('/', [BuyerController::class, 'viewHomepage'])->name('viewHomepage');
Route::get('/series', [BuyerController::class, 'viewSeries'])->name('viewSeries');
Route::get('/brand', [BuyerController::class, 'viewBrand'])->name('viewBrand');

Route::get('/catalog/detail/{id}', [BuyerController::class, 'viewDetail'])->name('viewDetail');

Route::get('/user/profile/{id}', [BuyerController::class, 'viewProfile'])->name('viewProfile');
Route::post('/user/profile/update', [BuyerController::class, 'updateProfile'])->name('buyer.updateProfile');

Route::get('/user/profile/password/{id}', [BuyerController::class, 'viewGantiPassword'])->name('viewGantiPassword');
Route::post('/user/profile/password/update', [BuyerController::class, 'updatePassword'])->name('buyer.updatePassword');


Route::post('/wishlist/add/{id}', [WishlistController::class, 'addToWishlist'])->name('wishlist.add');
Route::post('/wishlist/remove/{id}', [WishlistController::class, 'removeFromWishlist'])->name('wishlist.remove');
Route::get('/wishlist', [WishlistController::class, 'viewWishlist'])->name('wishlist.view');

Route::group(['middleware' => 'penyewa'], function () {
    
});
