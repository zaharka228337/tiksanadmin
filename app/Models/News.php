<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $casts =[
        'active' => 'boolean',
        'images_gallery' => 'array',
    ];

    protected $fillable =[
        'active',
        'title',
        'sorting',
        'date_publish',
        'preview_image',
        'detail_image',
        'news_body',
        'images_gallery',
        'youtube_video'
    ];
}
