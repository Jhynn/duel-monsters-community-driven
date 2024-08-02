<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Deck extends Model
{
    use HasFactory;

    /**
     * Get all of the decks's medias.
     */
    public function medias(): MorphMany
    {
        return $this->morphMany(Media::class, 'mediable');
    }
}
