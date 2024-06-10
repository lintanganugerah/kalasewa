<?php


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

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AutentikasiBuyerController;
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ProdukSellerController;
use App\Http\Controllers\AutentikasiSellerController;
use App\Http\Controllers\SellerController;


Route::get('/jadiseller', [SellerController::class, 'jadiSellerView'])->name('jadiSellerView');
Route::get('/login', [AutentikasiSellerController::class, 'loginView'])->name('loginView');
Route::get('/test', [SellerController::class, 'testView'])->name('seller.testView');

Route::post('/login/act', [AutentikasiSellerController::class, 'loginAction'])->name('seller.loginAction');

Route::get('/daftar/seller', [AutentikasiSellerController::class, 'registerView'])->name('seller.registerView');
Route::get('/daftar/buyer', [AutentikasiSellerController::class, 'registerViewBuyer'])->name('buyer.registerViewBuyer');

Route::post('/daftar/act/seller', [AutentikasiSellerController::class, 'checkEmailSeller'])->name('seller.registerAction');

Route::post('/daftar/act/buyer', [AutentikasiSellerController::class, 'checkEmailBuyer'])->name('buyer.registerAction');

Route::get('/daftar/seller/informasi', [AutentikasiSellerController::class,'registerInformationView'])->name('seller.registerInformationView');

Route::post('/daftar/seller/informasi/act', [AutentikasiSellerController::class,'registerInformationActionSeller'])->name('seller.registerInformationActionSeller');

Route::get('/resend/verify', [AutentikasiSellerController::class, 'resendVerify'])->name('seller.resendVerify');

Route::get('/daftar/verifikasi', [AutentikasiSellerController::class, 'verifikasiView'])->name('seller.verifikasiView');
Route::get('/daftar/verified', [AutentikasiSellerController::class, 'verifiedView'])->name('seller.verifiedView');

Route::get('/email/verify/{id}/{hash}', [AutentikasiSellerController::class, 'verify'])->name('verification.verify');

Route::get('/forgot-password', [AutentikasiSellerController::class,'viewForgotPass'])->name('viewForgotPass');

Route::post('/forgot-password', [AutentikasiSellerController::class,'ForgotPassAction'])->name('ForgotPassAction');

Route::get('/reset-password/{token}', [AutentikasiSellerController::class,'viewresetPass'])->name('password.reset');

Route::post('/reset-password', [AutentikasiSellerController::class,'resetPassAction'])->name('resetPassAction');

// Penyewa SEMUA ROUTE
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


Route::get('/daftar/buyer', [AutentikasiBuyerController::class, 'registerViewBuyer'])->name('buyer.registerViewBuyer');
Route::post('/daftar/act/buyer', [AutentikasiBuyerController::class, 'registerActionBuyer'])->name('buyer.registerAction'); 

Route::get('/daftar/buyer/informasi', [AutentikasiBuyerController::class, 'registerInformationView'])->name('buyer.registerInformationView'); 
Route::post('/daftar/buyer/informasi/act', [AutentikasiBuyerController::class, 'registerInformationAction'])->name('buyer.registerInformationAction'); 


Route::get('/search', [CatalogController::class, 'search'])->name('search');

Route::get('/logout/buyer', [AutentikasiBuyerController::class, 'logout'])->name('userLogout'); 

Route::group(['middleware' => 'penyewa'], function () {
});

//Pemilik Sewa SEMUA ROUTE
Route::group(['middleware' => 'pemilik_sewa'], function () {
    
    Route::get('/beranda', [SellerController::class, 'sellerBerandaView'])->name('seller.berandaView');
    
    Route::get('/profil/toko', [SellerController::class, 'profilTokoView'])->name('seller.profilTokoView');

    Route::post('/profil/toko/act', [SellerController::class, 'profilTokoAction'])->name('seller.profilTokoAction');
    
    Route::get('/pesanan/perluproses', function () {
        return view('pesanan.perluproses');
    });  

    Route::get('/produk/tambahproduk', [ProdukSellerController::class, 'viewTambahProduk'])->name('seller.viewTambahProduk');

    Route::get('/produk/produkanda', [ProdukSellerController::class, 'viewProdukAnda'])->name('seller.viewProdukAnda');

    Route::post('/produk/tambahproduk/act', [ProdukSellerController::class, 'tambahProdukAction'])->name('seller.tambahProdukAction');

    Route::post('/produk/{id}/arsipkan', [ProdukSellerController::class,'arsipProduk'])->name('seller.arsipProduk');
    Route::post('/produk/{id}/aktifkan', [ProdukSellerController::class,'aktifkanProduk'])->name('seller.aktifkanProduk');
    Route::post('/produk/{id}/delete', [ProdukSellerController::class,'hapusProduk'])->name('seller.hapusProduk');

    Route::get('/produk/edit/{id}', [ProdukSellerController::class, 'viewEditProduk'])->name('seller.viewEditProduk');
    Route::post('/produk/edit/{id}/act', [ProdukSellerController::class, 'editProdukAction'])->name('seller.editProdukAction');
    Route::post('/produk/foto/{id}/delete', [ProdukSellerController::class,'hapusFoto'])->name('seller.hapusFoto');

    Route::get('/logout/seller', [AutentikasiSellerController::class, 'logout'])->name('seller.logout');
});

