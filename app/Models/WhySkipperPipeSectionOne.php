<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhySkipperPipeSectionOne extends Model
{
    protected $table = 'why_skipper_pipe_section_ones';

    protected $fillable = [
        'why_skipper_pipe_id',
        'description',
        'images'
    ];

    protected $casts = [
        'images' => 'array'
    ];

    public function whySkipperPipe()
    {
        return $this->belongsTo(WhySkipperPipe::class);
    }
}
