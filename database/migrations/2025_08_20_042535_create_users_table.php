<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique()->nullable(); // Bisa null, karena user dari Telegram mungkin tidak punya email
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable(); // Bisa null jika login via Telegram
            $table->string('status')->default('pending'); // pending, active, suspended
            $table->string('role')->default('user'); // user, admin, dll.
            $table->string('telegram_id')->nullable(); // Untuk menyimpan Telegram chat ID
            $table->string('telegram_username')->nullable(); // Optional, untuk referensi
            $table->timestamp('approved_at')->nullable(); // Waktu persetujuan admin
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Batalkan migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
