<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
