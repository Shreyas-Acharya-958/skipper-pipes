<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaSectionOne extends Model
{
    use HasFactory;

    protected $table = 'media_section_ones';
    protected $fillable = [
        'title',
        'description',
    ];
}
