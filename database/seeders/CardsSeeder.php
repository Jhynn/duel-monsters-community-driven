<?php

namespace Database\Seeders;

use App\Models\Card;
use Illuminate\Database\Seeder;

class CardsSeeder extends Seeder
{
    protected $cards = [
        [
            'name' => '',
            'description' => '',
            'level' => 0,
            'attack' => 0,
            'defense' => 0,
        ],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $timestamp = now();

        foreach ($this->cards as &$record) {
            $record['created_at'] = $timestamp;
            $record['updated_at'] = $timestamp;
        }

        Card::insert($this->cards);
    }
}
