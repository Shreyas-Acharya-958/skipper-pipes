<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsSectionOne extends Model
{
    use HasFactory;

    protected $table = 'news_section_ones';
    protected $fillable = [
        'title',
        'description',
    ];
}
