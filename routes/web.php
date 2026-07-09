<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PesanController; // Sudah benar di sini
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. Halaman Utama / Welcome (Bisa diakses siapa saja tanpa login)
Route::get('/', function () {
    return view('welcome');
});

// Semua rute di bawah ini wajib login terlebih dahulu
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    // Rute untuk menampilkan form tambah barang
    Route::get('/admin/barang/create', [AdminController::class, 'create'])->name('admin.barang.create');
    
    // Rute untuk memproses penyimpanan data barang baru
    Route::post('/admin/barang/store', [AdminController::class, 'store'])->name('admin.barang.store');

    Route::get('/admin/laporan', [App\Http\Controllers\AdminController::class, 'laporan'])->name('admin.laporan');

    Route::post('/admin/pesanan/{id}/status', [App\Http\Controllers\AdminController::class, 'updateStatus'])->name('admin.pesanan.status');

    // Rute Manajemen Topping (Admin)
    Route::get('/admin/topping', [App\Http\Controllers\AdminController::class, 'toppingIndex'])->name('admin.topping');
    Route::post('/admin/topping', [App\Http\Controllers\AdminController::class, 'toppingStore'])->name('admin.topping.store');
    Route::delete('/admin/topping/{id}', [App\Http\Controllers\AdminController::class, 'toppingDestroy'])->name('admin.topping.destroy');
    Route::get('/admin/stok', [App\Http\Controllers\AdminController::class, 'stokIndex'])->name('admin.stok');
    Route::post('/admin/stok/{id}', [App\Http\Controllers\AdminController::class, 'tambahStok'])->name('admin.stok.tambah');
    // Rute Riwayat Pesanan
    Route::get('/riwayat', [App\Http\Controllers\PesanController::class, 'riwayat'])->name('riwayat');
    Route::post('/ulasan/{id}', [App\Http\Controllers\PesanController::class, 'kirimUlasan'])->name('ulasan.store');
    // 2. Rute /home Menggunakan HomeController
    Route::get('/home', [HomeController::class, 'index'])->name('home');


    // 3. Rute Dashboard Bawaan Breeze
    Route::get('/dashboard', function () {
        return redirect()->route('home'); 
    })->name('dashboard');

    // 4. Fitur Pemesanan Kopi & Keranjang Belanja (Sudah Terproteksi Aman)
    Route::get('/pesan/{id}', [PesanController::class, 'index']);
    Route::post('/pesan/{id}', [PesanController::class, 'pesan']);
    Route::get('/checkout', [PesanController::class, 'checkout']);
    Route::delete('/checkout/{id}', [PesanController::class, 'delete']);
    Route::get('/konfirmasi-checkout', [PesanController::class, 'konfirmasi']);
    

    // 5. Fitur Profile Bawaan Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';