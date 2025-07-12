<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhySkipperPipeSectionThree extends Model
{
    protected $table = 'why_skipper_pipe_section_threes';

    protected $fillable = [
        'why_skipper_pipe_id',
        'title',
        'images',
        'description'
    ];

    protected $casts = [
        'images' => 'array'
    ];

    public function whySkipperPipe()
    {
        return $this->belongsTo(WhySkipperPipe::class);
    }
}
