<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'file_type',
        'file',
        'thumbnail',
        'media_type',
        'sequence',
    ];

    protected $casts = [
        'sequence' => 'integer',
    ];
}
