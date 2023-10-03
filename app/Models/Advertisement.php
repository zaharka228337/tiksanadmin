<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use HasFactory;

    protected $casts = [
        'active' => 'boolean'
    ];

    protected $fillable = [
        'active',
        'title',
        'sorting',
        'image'
    ];
}
