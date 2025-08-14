<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TelegramBotController;
use App\Http\Controllers\Api\TransactionController;
// routes/api.php
Route::post('/telegram/webhook', [TelegramBotController::class, 'handleWebhook']);
