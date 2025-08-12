<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Pakan extends Model {
    use HasFactory;
    protected $fillable = ['nama_pakan', 'jumlah_stok', 'satuan', 'tanggal_masuk', 'tanggal_kadaluarsa', 'supplier'];
}