<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DombaPertumbuhan extends Model
{
    protected $table = 'domba_pertumbuhan';

    protected $fillable = ['domba_id', 'bulan_ke', 'berat_badan', 'video_url'];

    public function domba()
    {
        return $this->belongsTo(Domba::class);
    }
}
