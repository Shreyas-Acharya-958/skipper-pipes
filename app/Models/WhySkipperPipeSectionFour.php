<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhySkipperPipeSectionFour extends Model
{
    protected $table = 'why_skipper_pipe_section_fours';

    protected $fillable = [
        'why_skipper_pipe_id',
        'image',
        'title',
        'description'
    ];

    public function whySkipperPipe()
    {
        return $this->belongsTo(WhySkipperPipe::class);
    }
}
