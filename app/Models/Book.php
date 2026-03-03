<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'author',
        'publisher',
        'published_date',
        'page_count',
        'purchased_date',
        'purchase_price',
        'reading_started_date',
        'reading_finished_date',
        'category',
        'tags',
        'reading_notes',
        'status',
        'isbn',
        'source',
        'source_id',
        'cover_image_url',
    ];

    protected $casts = [
        'page_count' => 'integer',
        'purchased_date' => 'date',
        'purchase_price' => 'integer',
        'reading_started_date' => 'date',
        'reading_finished_date' => 'date',
        'tags' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeForUser(Builder $query, int $userId): Builder
    {
        return $query->where('user_id', $userId);
    }
}
