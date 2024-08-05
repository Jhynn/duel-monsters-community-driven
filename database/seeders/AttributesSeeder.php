<?php

namespace Database\Seeders;

use App\Models\Attribute;
use Illuminate\Database\Seeder;

class AttributesSeeder extends Seeder
{
    protected $attributes = [
        [
            'name' => 'dark',
        ],
        [
            'name' => 'light',
        ],
        [
            'name' => 'fire',
        ],
        [
            'name' => 'water',
        ],
        [
            'name' => 'wind',
        ],
        [
            'name' => 'earth',
        ],
        [
            'name' => 'divine',
        ],
        [
            'name' => 'trap',
        ],
        [
            'name' => 'spell',
        ],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $timestamp = now();

        foreach ($this->attributes as &$record) {
            $record['created_at'] = $timestamp;
            $record['updated_at'] = $timestamp;
        }

        Attribute::insert($this->attributes);
    }
}
