<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{
    BelongsTo,
    MorphMany
};

class Deck extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'deck_artwork_id',
        'card_sleeve_id',
    ];

    /**
     * Get all of the decks's medias.
     */
    public function medias(): MorphMany
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    public function style(): BelongsTo
    {
        return $this->belongsTo(Style::class);
    }
}
