<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('peralatans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_alat');
            $table->integer('jumlah_unit');
            $table->enum('kondisi', ['Baik', 'Rusak', 'Perbaikan']);
            $table->string('lokasi_penyimpanan')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('peralatans'); }
};
