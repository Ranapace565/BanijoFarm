<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Obat extends Model {
    use HasFactory;
    protected $fillable = ['nama_obat', 'fungsi', 'jumlah_stok', 'satuan', 'tanggal_kadaluarsa'];
}