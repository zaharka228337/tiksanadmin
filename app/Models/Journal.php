<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    use HasFactory;

    protected $casts = [
        'active' => 'boolean'
    ];

    protected $fillable = [
        'active',
        'totle',
        'sorting',
        'date_publish',
        'preview_image',
        'detail_image',
        'pdf'
    ];
}
