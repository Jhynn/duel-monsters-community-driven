<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{
    BelongsTo,
    BelongsToMany,
    MorphMany
};

class Card extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'level',
        'attack',
        'defense',
        'attribute_id',
        'race_id',
        'type_id',
        'metadata',
        'created_at',
        'updated_at',
    ];

    public function casts(): array
    {
        return [
            'metadata' => 'array',
        ];
    }

    public function attribute(): BelongsTo
    {
        return $this->belongsTo(Attribute::class);
    }

    public function race(): BelongsTo
    {
        return $this->belongsTo(Race::class);
    }

    public function types(): BelongsToMany
    {
        return $this->belongsToMany(Type::class);
    }

    /**
     * Get all of the card's medias.
     */
    public function medias(): MorphMany
    {
        return $this->morphMany(Media::class, 'mediable');
    }
}
