<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $casts = [
        'active' => 'boolean'
    ];

    protected $fillable = [
        'active',
        'title',
        'sorting',
        'preview_image',
        'detail_image',
        'detail_text'
    ];
}
