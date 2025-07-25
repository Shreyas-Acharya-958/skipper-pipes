<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CertificationHeadSection extends Model
{
    protected $table = 'certification_head_section';
    protected $fillable = [
        'title',
        'description',
    ];
}
