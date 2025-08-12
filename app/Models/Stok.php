<?php

namespace App\Models; // <-- Pastikan namespace ini benar

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// <-- Pastikan nama class adalah 'Stok' (S besar, tanpa 'ck')
class Stok extends Model
{
    use HasFactory;

    // Menentukan nama tabel secara eksplisit
    protected $table = 'stoks';

    // Kolom-kolom yang boleh diisi
    protected $fillable = [
        'kode_domba',
        'jenis_kelamin',
        'tanggal_lahir',
        'berat',
        'harga_jual',
        'status',
        'deskripsi',
    ];
}
