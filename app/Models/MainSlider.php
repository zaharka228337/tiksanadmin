<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MainSlider extends Model
{
    protected $casts = [
        'active' => 'boolean'
    ];

    protected $fillable = [
        'active',
        'title',
        'sorting',
        'date_publish',
        'detail_image',
        'logo',
        'organization',
        'description',
        'link',
    ];
}
