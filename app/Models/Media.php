<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{
    BelongsTo,
    MorphTo
};
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'mediable_id',
        'mediable_type',
        'url',
    ];

    protected $appends = [
        'link',
    ];

    /**
     * Get the parent mediable models.
     */
    public function mediable(): MorphTo
    {
        return $this->morphTo();
    }

    public function card(): BelongsTo
    {
        return $this->belongsTo(Card::class);
    }

    public function race(): BelongsTo
    {
        return $this->belongsTo(Race::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    protected function link(): Attribute
    {
        return Attribute::make(
            get: fn () => (isset($this->attributes['url']) ? Storage::disk('local')->url($this->attributes['url']) : null)
        );
    }
}
