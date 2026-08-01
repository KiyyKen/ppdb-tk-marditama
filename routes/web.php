<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PendaftaranController;

/*
|--------------------------------------------------------------------------
| Web Routes - PPDB TK Mardi Tama
|--------------------------------------------------------------------------
*/

// Public Routes (Halaman Depan & Pendaftaran)
Route::get('/', [HomeController::class, 'Dashboard'])->name('Dashboard');
Route::post('/cek-status', [HomeController::class, 'cekStatus'])->name('pendaftaran.cekStatus');
Route::post('/pendaftaran/create', [PendaftaranController::class, 'pendaftaranCreate'])->name('pendaftaran.create');

// Auth Routes (Login & Logout)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.post');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin Protected Routes (Wajib Login Sebagai Admin)
Route::middleware(['auth'])->group(function () {
    // Dashboard Admin
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');

    // Data Pendaftaran
    Route::get('/data-pendaftaran', [AdminController::class, 'pendaftaranAdmin'])->name('pendaftar.admin');
    Route::get('/admin/pendaftaran/export-csv', [AdminController::class, 'exportCsv'])->name('pendaftaran.exportCsv');
    Route::get('/pendaftaran/{id}', [AdminController::class, 'pendaftaranShow'])->name('pendaftaran.show');
    Route::get('/pendaftaran/{id}/cetak', [AdminController::class, 'pendaftaranCetak'])->name('pendaftaran.cetak');
    Route::put('/pendaftaran/{id}/status', [AdminController::class, 'updateStatus'])->name('pendaftaran.updateStatus');

    Route::get('/admin/pendaftaran/create', [AdminController::class, 'pendaftaranCreate'])->name('pendaftaran.admin.create');
    Route::post('/admin/pendaftaran/store', [AdminController::class, 'pendaftaranStore'])->name('pendaftaran.store');
    Route::get('/pendaftaran/{id}/edit', [AdminController::class, 'pendaftaranEdit'])->name('pendaftaran.edit');
    Route::put('/pendaftaran/{id}', [AdminController::class, 'pendaftaranUpdate'])->name('pendaftaran.update');
    Route::delete('/pendaftaran/{id}', [AdminController::class, 'pendaftaranDestroy'])->name('pendaftaran.destroy');

    // Pengaturan Biaya & Gelombang
    Route::get('/admin/settings', [AdminController::class, 'settingsIndex'])->name('settings.admin');
    Route::put('/admin/settings', [AdminController::class, 'settingsUpdate'])->name('settings.update');

    // Profil & Password Admin
    Route::get('/admin/profile', [AdminController::class, 'profileEdit'])->name('profile.admin');
    Route::put('/admin/profile', [AdminController::class, 'profileUpdate'])->name('profile.update');

    // Data User Admin
    Route::get('/data-admin', [AdminController::class, 'dataAdmin'])->name('data.admin');
    Route::get('/admin-create', [AdminController::class, 'adminCreate'])->name('admin.create');
    Route::post('/admin/store', [AdminController::class, 'adminStore'])->name('admin.store');
    Route::get('/admin/{id}/edit', [AdminController::class, 'adminEdit'])->name('admin.edit');
    Route::put('/admin/{id}', [AdminController::class, 'adminUpdate'])->name('admin.update');
    Route::delete('/admin/{id}', [AdminController::class, 'adminDestroy'])->name('admin.destroy');
});