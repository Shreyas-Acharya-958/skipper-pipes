<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqMaster extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'sequence',
        'status'
    ];

    protected $casts = [
        'sequence' => 'integer',
        'status' => 'boolean'
    ];

    public function faqLists()
    {
        return $this->hasMany(FaqList::class)->orderBy('sequence');
    }
}
