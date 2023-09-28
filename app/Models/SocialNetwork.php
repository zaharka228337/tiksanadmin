<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialNetwork extends Model
{
    protected $fillable = [
        'vk',
        'telegram',
        'youtube',
        'dzen',
        'vcru',
        'instagram'
    ];
}
