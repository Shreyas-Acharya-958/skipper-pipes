<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeSectionOne extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'video',
        'now_more'
    ];

    public function features()
    {
        return $this->hasMany(HomeSectionOneFeature::class, 'section_one_id');
    }
}
