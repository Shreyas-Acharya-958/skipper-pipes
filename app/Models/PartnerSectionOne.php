<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartnerSectionOne extends Model
{
    protected $fillable = [
        'partner_id',
        'image',
        'description'
    ];

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }
}
