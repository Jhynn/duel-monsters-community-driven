<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{
    BelongsToMany,
    MorphMany
};

class Attribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function cards(): BelongsToMany
    {
        return $this->belongsToMany(Card::class);
    }

    /**
     * Get all of the attribute's medias.
     */
    public function medias(): MorphMany
    {
        return $this->morphMany(Media::class, 'mediable');
    }
}
