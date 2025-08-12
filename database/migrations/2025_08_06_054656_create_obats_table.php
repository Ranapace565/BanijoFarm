<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('pakans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pakan');
            $table->decimal('jumlah_stok', 10, 2);
            $table->string('satuan'); // Kg, Karung, Ton
            $table->date('tanggal_masuk');
            $table->date('tanggal_kadaluarsa')->nullable();
            $table->string('supplier')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('pakans'); }
};
