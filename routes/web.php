<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\DombaController;
use App\Http\Controllers\PakanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PeralatanController;
use App\Http\Controllers\TelegramBotController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\KeuanganController;
// use App\Http\Controllers\Auth\LoginController;

// // Rute untuk menampilkan halaman login
// Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// // Rute untuk memproses data login
// Route::post('/login', [LoginController::class, 'login']);

// // Rute untuk logout
// Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// Rute Dashboard
Route::get('/', [DashboardController::class, 'index']);
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// === RUTE UNTUK STOK (LENGKAP) ===
Route::get('/stok', [StokController::class, 'index'])->name('stok.index');
// // Pakan
// Route::post('/pakan', [PakanController::class, 'store'])->name('pakan.store');
// Route::get('/pakan/{id}', [PakanController::class, 'show'])->name('pakan.show');
// Route::put('/pakan/{id}', [PakanController::class, 'update'])->name('pakan.update');
// Route::delete('/pakan/{id}', [PakanController::class, 'destroy'])->name('pakan.destroy');
// // Obat
// Route::post('/obat', [ObatController::class, 'store'])->name('obat.store');
// Route::get('/obat/{id}', [ObatController::class, 'show'])->name('obat.show');
// Route::put('/obat/{id}', [ObatController::class, 'update'])->name('obat.update');
// Route::delete('/obat/{id}', [ObatController::class, 'destroy'])->name('obat.destroy');
// // Peralatan
// Route::post('/peralatan', [PeralatanController::class, 'store'])->name('peralatan.store');
// Route::get('/peralatan/{id}', [PeralatanController::class, 'show'])->name('peralatan.show');
// Route::put('/peralatan/{id}', [PeralatanController::class, 'update'])->name('peralatan.update');
// Route::delete('/peralatan/{id}', [PeralatanController::class, 'destroy'])->name('peralatan.destroy');

// === RUTE UNTUK LAPORAN (LENGKAP) ===
Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
Route::get('/laporan/export', [LaporanController::class, 'export'])->name('laporan.export');

// Rute Notifikasi & Ekspor (masih dummy)
Route::get('/ekspor', function () {
    return view('pages.ekspor');
});
Route::get('/notifikasi', function () {
    return view('pages.notifikasi');
});

Route::get('/pelanggan-supplier', [KontakController::class, 'index'])->name('kontak.index');

// Rute untuk proses CRUD (Create, Read, Update, Delete)
Route::post('/kontak', [KontakController::class, 'store'])->name('kontak.store');
Route::get('/kontak/{id}', [KontakController::class, 'show'])->name('kontak.show');
Route::put('/kontak/{id}', [KontakController::class, 'update'])->name('kontak.update'); // Untuk update
Route::delete('/kontak/{id}', [KontakController::class, 'destroy'])->name('kontak.destroy'); // Untuk delete

// Route::post('/telegram/webhook', [TelegramBotController::class, 'handleWebhook']);
// Route::post('/telegram/webhook', function (Request $request) {
//     $update = Telegram::commandsHandler(true);
//     Log::info('Telegram Update:', $request->all());
//     return 'ok'; // WAJIB return string agar tidak 419
// });
Route::post('/telegram/webhook', [TelegramBotController::class, 'handleWebhook']);

// Rute ini akan menangani semua kebutuhan CRUD untuk keuangan
Route::resource('domba', DombaController::class);
Route::resource('keuangan', KeuanganController::class);
Route::resource('kontak', KontakController::class);