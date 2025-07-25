<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqSectionOne extends Model
{
    use HasFactory;

    protected $table = 'faq_section_ones';
    protected $fillable = [
        'title',
        'description',
    ];
}
