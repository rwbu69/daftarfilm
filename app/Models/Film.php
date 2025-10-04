<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Film extends Model
{
    protected $fillable = [
        'title',
        'genre',
        'year',
        'rating',
        'watched',
        'image',
        'user_id'
    ];

    protected $casts = [
        'watched' => 'boolean',
        'rating' => 'decimal:1',
        'year' => 'integer'
    ];

    /**
     * Get the user that owns the film.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
