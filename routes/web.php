<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Admin\UserController; // <-- Tambahkan ini
use App\Http\Controllers\Admin\RoleController; // <-- Tambahkan ini
use App\Http\Controllers\Admin\ProductController; // <-- Tambahkan ini
use App\Http\Controllers\Admin\CategoryController; // <-- Tambahkan ini

// Halaman utama sekarang langsung redirect ke login jika belum terautentikasi
Route::get('/', function () {
    return redirect()->route('login');
});

// Grup untuk Rute Tamu (yang belum login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});



// Grup untuk Rute yang Membutuhkan Autentikasi
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    // --- RUTE BARU UNTUK MANAJEMEN AKSES ---
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    // -----------------------------------------

    // --- RUTE BARU UNTUK MANAJEMEN Barang ---
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    // -----------------------------------------


    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
