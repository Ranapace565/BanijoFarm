<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\DombaController;
use App\Http\Controllers\PakanController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PeralatanController;
use App\Http\Controllers\TelegramBotController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\DombaPertumbuhanController;
// use App\Http\Controllers\Auth\LoginController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::middleware(['auth', 'Admin'])->group(function () {
    Route::get('/admin/users', [UserManagementController::class, 'index'])->name('admin.users');
    Route::post('/admin/users/{id}/approve', [UserManagementController::class, 'approve'])->name('admin.users.approve');
    Route::post('/admin/users/{id}/reject', [UserManagementController::class, 'reject'])->name('admin.users.reject');
    Route::post('/admin/users/{id}/toggle-status', [UserManagementController::class, 'toggleStatus'])->name('admin.users.toggle');
});


Route::middleware(['auth'])->group(function () {
    // === RUTE DASHBOARD ===
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index']); // duplikat tetap, agar /dashboard & / sama

    // === STOK ===
    Route::get('/stok', [StokController::class, 'index'])->name('stok.index');

    // === LAPORAN ===
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/export', [LaporanController::class, 'export'])->name('laporan.export');

    // === HALAMAN BIASA ===
    Route::get('/ekspor', fn() => view('pages.ekspor'))->name('ekspor');
    Route::get('/notifikasi', fn() => view('pages.notifikasi'))->name('notifikasi');

    // === TELEGRAM BOT ===
    Route::post('/telegram/webhook', [TelegramBotController::class, 'handleWebhook'])->name('telegram.webhook');

    // === RESOURCE ROUTES ===
    Route::resource('domba', DombaController::class);
    Route::resource('keuangan', KeuanganController::class);
    Route::resource('kontak', KontakController::class);

    Route::get('/domba/{domba}/edit', [DombaController::class, 'edit'])->name('domba.edit');
    Route::post('/domba/{domba}/update', [DombaController::class, 'update'])->name('domba.update');

    // === PERTUMBUHAN DOMBA (CRUD NESTED) ===
    Route::prefix('domba')->group(function () {
        Route::get('{domba}/pertumbuhan', [DombaPertumbuhanController::class, 'index'])->name('pertumbuhan.index');
        Route::get('{domba}/pertumbuhan/create', [DombaPertumbuhanController::class, 'create'])->name('pertumbuhan.create');
        Route::post('{domba}/pertumbuhan', [DombaPertumbuhanController::class, 'store'])->name('pertumbuhan.store');
        Route::get('pertumbuhan/{pertumbuhan}/edit', [DombaPertumbuhanController::class, 'edit'])->name('pertumbuhan.edit');
        Route::put('pertumbuhan/{pertumbuhan}', [DombaPertumbuhanController::class, 'update'])->name('pertumbuhan.update');
        Route::delete('pertumbuhan/{pertumbuhan}', [DombaPertumbuhanController::class, 'destroy'])->name('pertumbuhan.destroy');
    });
});
