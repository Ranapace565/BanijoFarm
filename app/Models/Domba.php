<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Domba extends Model {
    use HasFactory;
    protected $fillable = ['kode_domba', 'jenis_kelamin', 'usia', 'ras', 'status', 'tanggal_masuk', 'asal_domba'];
}