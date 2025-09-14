<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\Admin\BidanController;
use App\Http\Controllers\Admin\BidanDisekitarController;
use App\Http\Controllers\Admin\BidanTerdaftarController;
use App\Http\Controllers\Admin\CheckoutController;
use App\Http\Controllers\Admin\KabupatenController;
use App\Http\Controllers\Admin\LayananController;
use App\Http\Controllers\Admin\LayananKategoriController;
use App\Http\Controllers\Admin\PasienTerdaftarController;
use App\Http\Controllers\Admin\ProvinsiController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return redirect()->route('login');
});


Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');  // Menampilkan form registrasi
    Route::post('/register', [RegisterController::class, 'register']); // Proses registrasi
});

// Grup untuk Rute yang Membutuhkan Autentikasi
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/kabupaten/{idprovinsi}', [DashboardController::class, 'getKabupatensByProvinsi']);
    Route::post('/bidan', [DashboardController::class, 'storeOrUpdate'])->name('bidan.store'); // Store baru
    Route::put('/bidan/{id}', [DashboardController::class, 'storeOrUpdate'])->name('bidan.update'); // Update

    Route::post('/pasien', [DashboardController::class, 'storeOrUpdatePasien'])->name('pasien.store'); // Store baru
    Route::put('/pasien/{id}', [DashboardController::class, 'storeOrUpdatePasien'])->name('pasien.update'); // Update

    // --- RUTE BARU UNTUK MANAJEMEN AKSES ---
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('menus', MenuController::class);


    // -----------------------------------------

    // --- RUTE BARU UNTUK MANAJEMEN Barang ---
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    // -----------------------------------------

    Route::resource('provinsis', ProvinsiController::class);
    Route::resource('kabupatens', KabupatenController::class);
    Route::resource('layanankategoris', LayananKategoriController::class);
    Route::resource('layanans', LayananController::class);

    Route::resource('bidanterdaftars', BidanTerdaftarController::class);
    Route::resource('bidanpengajuans', BidanController::class);
    Route::put('/bidan/approve/{id}', [BidanController::class, 'approve'])->name('bidan.approve');
    Route::put('/bidan/unapprove/{id}', [BidanController::class, 'unapprove'])->name('bidan.unapprove');
    Route::get('/bidan/{id}/profile', [BidanController::class, 'profile'])->name('bidan.profile');

    Route::resource('pasienterdaftars', PasienTerdaftarController::class);
    Route::resource('bidandisekitars', BidanDisekitarController::class);

    // --- RUTE UNTUK PROFILE ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('audit-logs', [ActivityLogController::class, 'index'])->name('audit-logs.index');

    Route::post('/checkout', [CheckoutController::class, 'store']);
    Route::get('/checkout/order', [CheckoutController::class, 'order'])->name('checkout.order');
    Route::get('/checkout/{id}/detail', [CheckoutController::class, 'orderDetail'])->name('checkout.detail');

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
