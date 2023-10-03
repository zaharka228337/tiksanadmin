<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $casts = [
        'active' => 'boolean',
        'gallery_images' => 'array'
    ];

    protected $fillable = [
        'active',
        'title',
        'sorting',
        'date_publish',
        'preview_image',
        'gallery_images'
    ];
}
