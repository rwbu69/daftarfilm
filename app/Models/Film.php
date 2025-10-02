<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $fillable = [
        'title',
        'genre',
        'year',
        'rating',
        'watched',
        'image'
    ];

    protected $casts = [
        'watched' => 'boolean',
        'rating' => 'decimal:1',
        'year' => 'integer'
    ];
}
