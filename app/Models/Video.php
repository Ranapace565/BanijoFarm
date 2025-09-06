<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = [
        'sheep_id',
        'user_id',
        'title',
        'drive_file_id',
        'drive_link'
    ];

    public function sheep()
    {
        return $this->belongsTo(Domba::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
