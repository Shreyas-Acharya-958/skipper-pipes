<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JalRakshakPhotoCategory extends Model
{
    protected $fillable = [
        'name',
        'description'
    ];

    public function galleries()
    {
        return $this->hasMany(JalRakshakGallery::class, 'category_id');
    }
}
