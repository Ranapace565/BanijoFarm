<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dombas', function (Blueprint $table) {
            $table->id();
            $table->string('kode_domba')->unique();
            $table->enum('jenis_kelamin', ['Jantan', 'Betina']);
            $table->string('usia')->nullable(); // <-- KOLOM TANGGAL LAHIR DIGANTI MENJADI USIA (TEKS)
            $table->string('ras')->nullable();
            $table->enum('status', ['Induk', 'Anak', 'Pejantan', 'Siap Jual', 'Terjual', 'Mati'])->default('Siap Jual');
            $table->date('tanggal_masuk');
            $table->string('asal_domba')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dombas');
    }
};
