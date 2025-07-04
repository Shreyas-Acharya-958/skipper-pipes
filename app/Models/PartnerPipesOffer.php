<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartnerPipesOffer extends Model
{
    protected $fillable = ['partner_id', 'image'];

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }
}
