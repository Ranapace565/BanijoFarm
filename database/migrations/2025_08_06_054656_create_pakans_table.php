<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('obats', function (Blueprint $table) {
            $table->id();
            $table->string('nama_obat');
            $table->string('fungsi');
            $table->decimal('jumlah_stok', 10, 2);
            $table->string('satuan'); // Botol, Tablet, ml
            $table->date('tanggal_kadaluarsa')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('obats'); }
};