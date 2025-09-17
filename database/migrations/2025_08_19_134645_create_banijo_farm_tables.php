<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_banijo_farm_tables.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel keuangan
        Schema::create('keuangan', function (Blueprint $table) {
            $table->id();
            $table->enum('jenis', ['pemasukan', 'pengeluaran']);
            $table->decimal('jumlah', 15, 2);
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });

        // Tabel domba - dibuat dari awal (bukan alter)
        Schema::create('domba', function (Blueprint $table) {
            $table->id();
            $table->string('jenis', 100)->nullable();
            $table->enum('status', ['tersedia', 'terjual', 'mati'])->default('tersedia');

            // Kolom baru
            $table->date('tanggal_lahir')->nullable();
            $table->string('induk', 100)->nullable();
            $table->string('jantan', 100)->nullable();
            $table->enum('gender', ['jantan', 'betina'])->nullable();
            $table->string('nama', 100)->nullable();
            $table->time('jam_lahir')->nullable();
            $table->decimal('bb_lahir', 8, 2)->nullable()->comment('Berat badan saat lahir');

            // Data kematian
            $table->date('tanggal_kematian')->nullable();
            $table->string('no_tag', 50)->nullable()->unique();
            $table->string('penyebab_kematian', 255)->nullable();

            $table->text('keterangan')->nullable();
            $table->timestamps();
        });

        // Histori BB per bulan
        Schema::create('domba_pertumbuhan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('domba_id')->constrained('domba')->onDelete('cascade');
            $table->integer('bulan_ke'); // 1, 2, 3
            $table->decimal('berat_badan', 8, 2);
            $table->string('video_url')->nullable()->comment('URL ke Google Drive atau storage');
            $table->timestamps();
        });

        // Tabel kontak
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
        Schema::dropIfExists('domba_pertumbuhan');
        Schema::dropIfExists('domba');
        Schema::dropIfExists('kontak');
    }
};
