<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domba extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'domba';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'jenis',
        'umur',
        'harga',
        'status',
        'keterangan',
    ];

    /**
     * The attributes that should be cast.
     * INI ADALAH PERBAIKANNYA.
     * Ini akan mengubah 'created_at' dan 'updated_at' menjadi objek Tanggal (Carbon)
     * setiap kali data diakses, sehingga fungsi ->format() bisa digunakan.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}