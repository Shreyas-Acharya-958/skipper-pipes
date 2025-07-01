<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeSectionOne extends Model
{
    protected $fillable = ['title', 'image', 'description'];

    public function features()
    {
        return $this->hasMany(HomeSectionOneFeature::class, 'section_one_id');
    }
}
