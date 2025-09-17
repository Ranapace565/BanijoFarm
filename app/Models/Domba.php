<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domba extends Model
{
    use HasFactory;

    protected $table = 'domba';

    protected $fillable = [
        'jenis',
        'status',
        'tanggal_lahir',
        'induk',
        'jantan',
        'gender',
        'nama',
        'jam_lahir',
        'bb_lahir',
        'tanggal_kematian',
        'no_tag',
        'penyebab_kematian',
        'keterangan'
    ];

    public function pertumbuhan()
    {
        return $this->hasMany(DombaPertumbuhan::class);
    }

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
