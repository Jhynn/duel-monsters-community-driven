<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{
    BelongsTo,
    HasMany
};

class Style extends Model
{
    protected $fillable = [
        'name',
        'description',
        'code',
        'user_id',
    ];

    use HasFactory;

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function cards(): HasMany
    {
        return $this->hasMany(Card::class, 'card_sleeve_id');
    }

    public function decks(): HasMany
    {
        return $this->hasMany(Deck::class, 'deck_artwork_id');
    }

    public function playmates(): HasMany
    {
        return $this->hasMany(Playmate::class);
    }
}
