<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    use HasFactory;

    protected $casts = [
        'active' => 'boolean'
    ];

    protected $fillable = [
        'active',
        'title',
        'sorting',
        'date_publish',
        'detail_image',
        'detail_text',
        'hh_link',
    ];
}
