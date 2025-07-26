<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogSectionOne extends Model
{
    use HasFactory;

    protected $table = 'blog_section_ones';
    protected $fillable = [
        'title',
        'description',
    ];
}
