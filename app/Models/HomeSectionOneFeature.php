<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeSectionOneFeature extends Model
{
    protected $fillable = ['section_one_id', 'title', 'icon', 'sequence'];

    public function section()
    {
        return $this->belongsTo(HomeSectionOne::class, 'section_one_id');
    }
}
