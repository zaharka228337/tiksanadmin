<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * Указывает, что идентификаторы модели являются автоинкрементными.
     *
     * @var bool
     */
    public $incrementing = true;
    public $timestamps = false;

    protected $casts = [
        'boolean' => 'active'
    ];

    protected $fillable = [
        'sorting',
        'active',
        'name',
        'url'
    ];
}
