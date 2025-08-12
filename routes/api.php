<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TransactionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Di sini kita mendaftarkan rute API untuk aplikasi kita. Rute-rute ini
| secara otomatis akan memiliki prefix /api.
|
*/

// Pintu untuk menerima data pemasukan dari bot
// URL lengkapnya akan menjadi: http://127.0.0.1:8000/api/pemasukan
Route::post('/pemasukan', [TransactionController::class, 'storePemasukan']);

// Pintu untuk menerima data pengeluaran dari bot
// URL lengkapnya akan menjadi: http://127.0.0.1:8000/api/pengeluaran
Route::post('/pengeluaran', [TransactionController::class, 'storePengeluaran']);
