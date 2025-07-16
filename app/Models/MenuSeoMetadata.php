<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuSeoMetadata extends Model
{
    protected $fillable = [
        'menu_id',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
