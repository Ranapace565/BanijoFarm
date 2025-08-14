<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\DombaController;
use App\Http\Controllers\PakanController;
use Telegram\Bot\Laravel\Facades\Telegram;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\PeralatanController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\TelegramBotController;
use App\Http\Controllers\PelangganSupplierController;

// Rute Dashboard
Route::get('/', [DashboardController::class, 'dashboard']);

// === RUTE UNTUK PEMASUKAN (LENGKAP) ===
Route::get('/pemasukan', [PemasukanController::class, 'index'])->name('pemasukan.index');
Route::post('/pemasukan', [PemasukanController::class, 'store'])->name('pemasukan.store');
Route::get('/pemasukan/{id}', [PemasukanController::class, 'show'])->name('pemasukan.show');
Route::put('/pemasukan/{id}', [PemasukanController::class, 'update'])->name('pemasukan.update');
Route::delete('/pemasukan/{id}', [PemasukanController::class, 'destroy'])->name('pemasukan.destroy');

// === RUTE UNTUK PENGELUARAN (LENGKAP) ===
Route::get('/pengeluaran', [PengeluaranController::class, 'index'])->name('pengeluaran.index');
Route::post('/pengeluaran', [PengeluaranController::class, 'store'])->name('pengeluaran.store');
Route::get('/pengeluaran/{id}', [PengeluaranController::class, 'show'])->name('pengeluaran.show');
Route::put('/pengeluaran/{id}', [PengeluaranController::class, 'update'])->name('pengeluaran.update');
Route::delete('/pengeluaran/{id}', [PengeluaranController::class, 'destroy'])->name('pengeluaran.destroy');

// === RUTE UNTUK STOK (LENGKAP) ===
Route::get('/stok', [StokController::class, 'index'])->name('stok.index');
// Domba
Route::post('/domba', [DombaController::class, 'store'])->name('domba.store');
Route::get('/domba/{id}', [DombaController::class, 'show'])->name('domba.show');
Route::put('/domba/{id}', [DombaController::class, 'update'])->name('domba.update');
Route::delete('/domba/{id}', [DombaController::class, 'destroy'])->name('domba.destroy');
// Pakan
Route::post('/pakan', [PakanController::class, 'store'])->name('pakan.store');
Route::get('/pakan/{id}', [PakanController::class, 'show'])->name('pakan.show');
Route::put('/pakan/{id}', [PakanController::class, 'update'])->name('pakan.update');
Route::delete('/pakan/{id}', [PakanController::class, 'destroy'])->name('pakan.destroy');
// Obat
Route::post('/obat', [ObatController::class, 'store'])->name('obat.store');
Route::get('/obat/{id}', [ObatController::class, 'show'])->name('obat.show');
Route::put('/obat/{id}', [ObatController::class, 'update'])->name('obat.update');
Route::delete('/obat/{id}', [ObatController::class, 'destroy'])->name('obat.destroy');
// Peralatan
Route::post('/peralatan', [PeralatanController::class, 'store'])->name('peralatan.store');
Route::get('/peralatan/{id}', [PeralatanController::class, 'show'])->name('peralatan.show');
Route::put('/peralatan/{id}', [PeralatanController::class, 'update'])->name('peralatan.update');
Route::delete('/peralatan/{id}', [PeralatanController::class, 'destroy'])->name('peralatan.destroy');

// === RUTE UNTUK PELANGGAN & SUPPLIER (LENGKAP) ===
Route::get('/pelanggan-supplier', [PelangganSupplierController::class, 'index'])->name('pelanggan-supplier.index');
// Pelanggan
Route::post('/pelanggan', [PelangganController::class, 'store'])->name('pelanggan.store');
Route::get('/pelanggan/{id}', [PelangganController::class, 'show'])->name('pelanggan.show');
Route::put('/pelanggan/{id}', [PelangganController::class, 'update'])->name('pelanggan.update');
Route::delete('/pelanggan/{id}', [PelangganController::class, 'destroy'])->name('pelanggan.destroy');
// Supplier
Route::post('/supplier', [SupplierController::class, 'store'])->name('supplier.store');
Route::get('/supplier/{id}', [SupplierController::class, 'show'])->name('supplier.show');
Route::put('/supplier/{id}', [SupplierController::class, 'update'])->name('supplier.update');
Route::delete('/supplier/{id}', [SupplierController::class, 'destroy'])->name('supplier.destroy');

// === RUTE UNTUK LAPORAN (LENGKAP) ===
Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
Route::get('/laporan/export-csv', [LaporanController::class, 'exportCsv'])->name('laporan.exportCsv');

// Rute Notifikasi & Ekspor (masih dummy)
Route::get('/ekspor', function () {
    return view('pages.ekspor');
});
Route::get('/notifikasi', function () {
    return view('pages.notifikasi');
});

// Route::post('/telegram/webhook', [TelegramBotController::class, 'handleWebhook']);
// Route::post('/telegram/webhook', function (Request $request) {
//     $update = Telegram::commandsHandler(true);
//     Log::info('Telegram Update:', $request->all());
//     return 'ok'; // WAJIB return string agar tidak 419
// });
Route::post('/telegram/webhook', [TelegramBotController::class, 'handleWebhook']);
