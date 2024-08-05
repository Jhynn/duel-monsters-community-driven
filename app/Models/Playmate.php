<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Playmate extends Model
{
    protected $fillable = [
        'name',
        'descrition',
    ];

    use HasFactory;

    public function style(): BelongsTo
    {
        return $this->belongsTo(Style::class);
    }
}
