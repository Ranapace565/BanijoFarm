<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keuangan extends Model
{
    use HasFactory;

    /**
     * Memberitahu Laravel nama tabel yang sebenarnya di database.
     */
    protected $table = 'keuangan';

    /**
     * Memberitahu Laravel untuk mengelola kolom created_at dan updated_at secara otomatis.
     * Ini penting agar fitur "Aktivitas Terbaru" di dashboard Anda berfungsi.
     */
    public $timestamps = true;

    /**
     * Mendaftarkan kolom-kolom yang boleh diisi melalui form atau bot.
     */
    protected $fillable = [
        'tanggal',
        'jenis', // 'pemasukan' atau 'pengeluaran'
        'jumlah',
        'keterangan',
    ];

    /**
     * Mengubah tipe data secara otomatis saat diambil dari database.
     */
    protected $casts = [
        'tanggal' => 'datetime',
        'jumlah' => 'integer',
    ];
}