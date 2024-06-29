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
use App\Http\Controllers\AutentikasiController;
use App\Http\Controllers\AutentikasiSellerController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\PenyewaController;
use App\Http\Controllers\StatusPenyewaanController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PenilaianSisiSellerController;


// HOMEPAGE
Route::get('/', [PublicController::class, 'viewHomepage'])->name('viewHomepage');
Route::get('/series', [PublicController::class, 'viewSeries'])->name('viewSeries');
Route::get('/jadiseller', [SellerController::class, 'jadiSellerView'])->name('jadiSellerView');
Route::get('/test', [SellerController::class, 'testView'])->name('seller.testView');

// REGISTER
Route::get('/daftar/penyewa', [AutentikasiController::class, 'registerViewPenyewa'])->name('registerViewPenyewa');
Route::get('/daftar/pemiliksewa', [AutentikasiController::class, 'registerViewPemilikSewa'])->name('registerViewPemilikSewa');
Route::post('/daftar/act/penyewa', [AutentikasiController::class, 'checkEmailPenyewa'])->name('checkEmailPenyewa');
Route::post('/daftar/act/pemiliksewa', [AutentikasiController::class, 'checkEmailPemilikSewa'])->name('checkEmailPemilikSewa');
Route::get('/daftar/penyewa/informasi', [AutentikasiController::class, 'registerInformationViewPenyewa'])->name('registerInformationViewPenyewa');
Route::get('/daftar/pemiliksewa/informasi', [AutentikasiController::class, 'registerInformationViewPemilikSewa'])->name('registerInformationViewPemilikSewa');
Route::post('/daftar/penyewa/informasi/act', [AutentikasiController::class, 'registerInformationActionPenyewa'])->name('registerInformationActionPenyewa');
Route::post('/daftar/pemiliksewa/informasi/act', [AutentikasiController::class, 'registerInformationActionPemilikSewa'])->name('registerInformationActionPemilikSewa');

// VERIFIKASI
Route::get('/daftar/verifikasi/otp', [AutentikasiController::class, 'verifikasiViewOTP'])->name('verifikasiViewOTP');
Route::post('/verify-otp', [AutentikasiController::class, 'verifyOTP'])->name('verifyOTP');

// LOGIN
Route::get('/login', [AutentikasiController::class, 'loginView'])->name('loginView');
Route::post('/login/act', [AutentikasiController::class, 'loginAction'])->name('loginAction');

// LUPA PASSWORD
Route::get('/forgot-password', [AutentikasiController::class, 'viewForgotPass'])->name('viewForgotPass');
Route::post('/forgot-password', [AutentikasiController::class, 'ForgotPassAction'])->name('ForgotPassAction');
Route::get('/reset-password/{token}', [AutentikasiController::class, 'viewResetPass'])->name('password.reset');
Route::post('/reset-password/{token}/act', [AutentikasiController::class, 'resetPassAction'])->name('resetPassAction');

// PUBLIC ROUTE
Route::get('/catalog/detail/{id}', [PublicController::class, 'viewDetail'])->name('viewDetail');
Route::get('/rules', [PublicController::class, 'viewRules'])->name('viewRules');
Route::get('/about', [PublicController::class, 'viewAbout'])->name('viewAbout');
Route::get('/search', [PublicController::class, 'search'])->name('search');

//Logout
Route::get('/logout', [AutentikasiController::class, 'logout'])->name('logout');

// MIDDLEWARE PENYEWA
Route::group(['middleware' => 'penyewa'], function () {

    //Manajemen Profil
    Route::get('/user/profile/{id}', [PenyewaController::class, 'viewProfile'])->name('viewProfile');
    Route::post('/user/profile/update/act', [PenyewaController::class, 'updateProfile'])->name('updateProfilAction');


    //Update Password
    Route::get('/user/profile/password/{id}', [PenyewaController::class, 'viewGantiPassword'])->name('viewGantiPassword');
    Route::post('/user/profile/password/update', [PenyewaController::class, 'updatePassword'])->name('updatePasswordAction');

    //Wishlist
    Route::post('/wishlist/add/{id}', [WishlistController::class, 'addToWishlist'])->name('wishlist.add');
    Route::post('/wishlist/remove/{id}', [WishlistController::class, 'removeFromWishlist'])->name('wishlist.remove');
    Route::get('/wishlist', [WishlistController::class, 'viewWishlist'])->name('wishlist.view');

});

//Pemilik Sewa SEMUA ROUTE
Route::group(['middleware' => 'pemilik_sewa'], function () {

    Route::get('/dashboard/toko', [SellerController::class, 'sellerDashboardToko'])->name('seller.dashboardtoko');

    //TOKO ROUTE
    Route::get('/profil/toko', [SellerController::class, 'profilTokoView'])->name('seller.profilTokoView');

    Route::post('/profil/toko/act', [SellerController::class, 'profilTokoAction'])->name('seller.profilTokoAction');

    //PERATURAN SEWA
    Route::get('/profil/toko/peraturansewa', [SellerController::class, 'viewPeraturanSewaToko'])->name('seller.profil.viewPeraturanSewaToko');
    Route::get('/profil/toko/peraturansewa/edit/{id}', [SellerController::class, 'viewEditPeraturanSewa'])->name('seller.profil.viewEditPeraturanSewa');
    Route::get('/profil/toko/peraturansewa/tambah', [SellerController::class, 'viewTambahPeraturanSewa'])->name('seller.profil.viewTambahPeraturanSewa');

    Route::post('/profil/toko/peraturansewa/edit/{id}/act', [SellerController::class, 'EditPeraturanSewaAction'])->name('seller.profil.EditPeraturanSewaAction');
    Route::post('/profil/toko/peraturansewa/tambah/act', [SellerController::class, 'TambahPeraturanSewaAction'])->name('seller.profil.TambahPeraturanSewaAction');
    Route::post('/profil/toko/peraturansewa/delete/{id}', [SellerController::class, 'DeletePeraturanSewaAction'])->name('seller.profil.DeletePeraturanSewaAction');

    //ALAMAT TAMBAHAN / LAINNYA
    Route::get('/profil/toko/AlamatTambahan', [SellerController::class, 'viewAlamatTambahanToko'])->name('seller.profil.viewAlamatTambahanToko');
    Route::get('/profil/toko/AlamatTambahan/edit/{id}', [SellerController::class, 'viewEditAlamatTambahan'])->name('seller.profil.viewEditAlamatTambahan');
    Route::get('/profil/toko/AlamatTambahan/tambah', [SellerController::class, 'viewTambahAlamatTambahan'])->name('seller.profil.viewTambahAlamatTambahan');

    Route::post('/profil/toko/AlamatTambahan/edit/{id}/act', [SellerController::class, 'EditAlamatTambahanAction'])->name('seller.profil.EditAlamatTambahanAction');
    Route::post('/profil/toko/AlamatTambahan/tambah/act', [SellerController::class, 'TambahAlamatTambahanAction'])->name('seller.profil.TambahAlamatTambahanAction');
    Route::post('/profil/toko/AlamatTambahan/delete/{id}', [SellerController::class, 'DeleteAlamatTambahanAction'])->name('seller.profil.DeleteAlamatTambahanAction');

    //PRODUK ROUTE
    Route::get('/produk/tambahproduk', [ProdukSellerController::class, 'viewTambahProduk'])->name('seller.viewTambahProduk');

    Route::get('/produk/produkanda', [ProdukSellerController::class, 'viewProdukAnda'])->name('seller.viewProdukAnda');

    Route::post('/produk/tambahproduk/act', [ProdukSellerController::class, 'tambahProdukAction'])->name('seller.tambahProdukAction');

    Route::post('/produk/{id}/arsipkan', [ProdukSellerController::class, 'arsipProduk'])->name('seller.arsipProduk');
    Route::post('/produk/{id}/aktifkan', [ProdukSellerController::class, 'aktifkanProduk'])->name('seller.aktifkanProduk');
    Route::post('/produk/{id}/delete', [ProdukSellerController::class, 'hapusProduk'])->name('seller.hapusProduk');

    Route::get('/produk/edit/{id}', [ProdukSellerController::class, 'viewEditProduk'])->name('seller.viewEditProduk');
    Route::post('/produk/edit/{id}/act', [ProdukSellerController::class, 'editProdukAction'])->name('seller.editProdukAction');
    Route::post('/produk/foto/{id}/delete', [ProdukSellerController::class, 'hapusFoto'])->name('seller.hapusFoto');

    //LOGOUT ROUTE

    Route::get('/logout/seller', [AutentikasiSellerController::class, 'logout'])->name('seller.logout');

    //PESANAN
    Route::get('/status-sewa/belumdiproses', [StatusPenyewaanController::class, 'viewBelumDiProses'])->name('seller.statuspenyewaan.belumdiproses');
    Route::get('/status-sewa/dalampengiriman', [StatusPenyewaanController::class, 'viewDalamPengiriman'])->name('seller.statuspenyewaan.dalampengiriman');
    Route::get('/status-sewa/sedangberlangsung', [StatusPenyewaanController::class, 'viewSedangBerlangsung'])->name('seller.statuspenyewaan.sedangberlangsung');
    Route::get('/status-sewa/telahkembali', [StatusPenyewaanController::class, 'viewTelahKembali'])->name('seller.statuspenyewaan.telahkembali');
    Route::get('/status-sewa/penyewaandiretur', [StatusPenyewaanController::class, 'viewPenyewaanDiretur'])->name('seller.statuspenyewaan.penyewaandiretur');
    Route::get('/status-sewa/riwayat', [StatusPenyewaanController::class, 'viewRiwayatPenyewaan'])->name('seller.statuspenyewaan.riwayatPenyewaan');

    //KONFIRMASI RETUR SELESAI
    Route::post('/konfirmasi/returSelesai/{nomor_order}', [StatusPenyewaanController::class, 'returSelesai'])->name('seller.statuspenyewaan.returSelesai');

    //INGATKAN PENYEWA
    Route::post('/reminder/order/{nomor_order}/{id_penyewa}', [StatusPenyewaanController::class, 'ingatkanPenyewa'])->name('seller.statuspenyewaan.ingatkanPenyewa');

    //ORDER DIBATALKAN PEMILIK SEWA
    Route::post('/batal/order/{nomor_order}', [StatusPenyewaanController::class, 'dibatalkanPemilikSewa'])->name('seller.statuspenyewaan.dibatalkanPemilikSewa');

    //INPUT RESI
    Route::post('/inputresi/order/{nomor_order}', [StatusPenyewaanController::class, 'inputResi'])->name('seller.statuspenyewaan.inputResi');

    //REVIEW
    Route::get('/penilaian/produk', [PenilaianSisiSellerController::class, 'viewpenilaianProduk'])->name('seller.view.penilaian.penilaianProduk');
    Route::get('/penilaian/produk/{id}/detail', [PenilaianSisiSellerController::class, 'viewdetailPenilaianProduk'])->name('seller.view.penilaian.detailPenilaianProduk');
    Route::get('/penilaian/penyewa/{id}', [PenilaianSisiSellerController::class, 'viewReviewPenyewa'])->name('seller.view.penilaian.reviewPenyewa');

    //TAMBAH REVIEW PENYEWA DAN KONFIRMASI PENYEWAAN SELESAI
    Route::get('/tambah/penilaian/penyewa/{id}/{nomor_order}', [PenilaianSisiSellerController::class, 'viewTambahReviewPenyewa'])->name('seller.view.penilaian.TambahReviewPenyewa');
    Route::post('/tambah/penilaian/penyewa/{id}/{nomor_order}/act', [PenilaianSisiSellerController::class, 'tambahReviewPenyewaAction'])->name('seller.view.penilaian.tambahReviewPenyewaAction');
});

// ALL Admin Route
Route::group(['middleware' => 'admin'], function () {
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
    Route::post('/admin/users/{user}/nonaktifkan', [UserController::class, 'nonaktifkanUser'])->name('admin.users.nonaktifkan');

    // Verify Routes
    Route::get('/admin/verify', [UserController::class, 'index_verify'])->name('admin.verify.index');
    Route::put('/admin/users/{user}/verify', [UserController::class, 'updateVerification'])->name('admin.users.updateVerification');
    Route::get('/admin/users/{user}', [UserController::class, 'show'])->name('admin.users.show');
    Route::get('/banned', [AutentikasiController::class, 'viewBanned'])->name('viewBanned');
    Route::get('/rejected', [AutentikasiController::class, 'viewRejected'])->name('viewRejected');
    //Logout
    Route::get('/logout/admin', [AutentikasiController::class, 'logout'])->name('admin.logout');
    // Series Search
    Route::get('/admin/series/search', [SeriesController::class, 'search']);
});



//COMMENTED FROM ADMIN
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

//OLD ROUTE
// Route::get('/daftar/seller', [AutentikasiSellerController::class, 'registerView'])->name('seller.registerView');
// Route::get('/daftar/buyer', [AutentikasiSellerController::class, 'registerViewBuyer'])->name('buyer.registerViewBuyer');
// Route::post('/daftar/act/buyer', [AutentikasiSellerController::class, 'checkEmailBuyer'])->name('buyer.registerAction');
// Route::post('/daftar/act/seller', [AutentikasiSellerController::class, 'checkEmailSeller'])->name('seller.registerAction');
// Route::get('/daftar/seller/informasi', [AutentikasiSellerController::class,'registerInformationView'])->name('seller.registerInformationView');
// Route::get('/daftar/seller/informasi', [AutentikasiSellerController::class,'registerInformationView'])->name('seller.registerInformationView');
// Route::post('/daftar/seller/informasi/act', [AutentikasiSellerController::class,'registerInformationActionSeller'])->name('seller.registerInformationActionSeller');
// Route::post('/daftar/buyer/informasi/act', [AutentikasiBuyerController::class, 'registerInformationAction'])->name('buyer.registerInformationAction'); 
// Route::get('/daftar/verifikasi', [AutentikasiSellerController::class, 'verifikasiView'])->name('seller.verifikasiView');
// Route::get('/daftar/verified', [AutentikasiSellerController::class, 'verifiedView'])->name('seller.verifiedView');
// Route::get('/resend/verify', [AutentikasiSellerController::class, 'resendVerify'])->name('resendVerify');
// Route::post('/forgot-password', [AutentikasiSellerController::class, 'ForgotPassAction'])->name('ForgotPassAction');
// Route::get('/daftar/buyer', [AutentikasiBuyerController::class, 'registerViewBuyer'])->name('buyer.registerViewBuyer');
// Route::post('/daftar/act/buyer', [AutentikasiBuyerController::class, 'registerActionBuyer'])->name('buyer.registerAction');