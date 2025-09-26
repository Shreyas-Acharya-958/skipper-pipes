<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JalRakshakVideo extends Model
{
    protected $fillable = [
        'video_url',
        'video_file',
        'title',
        'sequence'
    ];
}
