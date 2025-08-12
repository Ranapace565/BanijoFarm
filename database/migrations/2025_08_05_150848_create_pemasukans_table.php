<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('pemasukans', function (Blueprint $table) {
        $table->id(); // Kolom ID otomatis
        $table->date('tanggal'); // Kolom untuk tanggal pemasukan
        $table->string('keterangan'); // Kolom untuk deskripsi, misal: "Penjualan 2 ekor domba"
        $table->decimal('jumlah', 15, 2); // Kolom untuk nominal uang, bisa menampung hingga 15 digit dengan 2 angka di belakang koma
        $table->timestamps(); // Kolom created_at dan updated_at otomatis
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemasukans');
    }
};
