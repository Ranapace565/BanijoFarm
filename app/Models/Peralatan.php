<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Peralatan extends Model {
    use HasFactory;
    protected $fillable = ['nama_alat', 'jumlah_unit', 'kondisi', 'lokasi_penyimpanan'];
}