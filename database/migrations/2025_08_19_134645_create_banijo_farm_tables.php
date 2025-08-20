<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_banijo_farm_tables.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel keuangan: identik dengan di python
        Schema::create('keuangan', function (Blueprint $table) {
            $table->id();
            $table->enum('jenis', ['pemasukan', 'pengeluaran']);
            $table->decimal('jumlah', 15, 2);
            $table->text('keterangan')->nullable();
            $table->timestamps(); // Menambahkan created_at dan updated_at
        });

        // Tabel domba: identik dengan di python
        Schema::create('domba', function (Blueprint $table) {
            $table->id();
            $table->string('jenis', 100)->nullable();
            $table->integer('umur')->nullable(); // dalam bulan
            $table->enum('status', ['tersedia', 'terjual', 'mati'])->default('tersedia');
            $table->decimal('harga', 15, 2)->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps(); // menggantikan tanggal_masuk
        });

        // Tabel kontak: identik dengan di python
        Schema::create('kontak', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 200);
            $table->string('no_hp', 50)->nullable();
            $table->enum('jenis', ['pelanggan', 'supplier']);
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('keuangan');
        Schema::dropIfExists('domba');
        Schema::dropIfExists('kontak');
    }
};