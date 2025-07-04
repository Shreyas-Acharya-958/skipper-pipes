<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartnerSectionTwo extends Model
{
    protected $fillable = [
        'partner_id',
        'title',
        'description'
    ];

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }
}
