<?php

namespace Database\Seeders;

use App\Models\{
    Attribute,
    Card,
    Media,
    Race,
    Type
};
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class CardsSeeder extends Seeder
{
    protected $cards = [
        // json
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $attributes = [
            'DARK' => Attribute::where('name', 'dark')->first()->id,
            'LIGHT' => Attribute::where('name', 'light')->first()->id,
            'EARTH' => Attribute::where('name', 'earth')->first()->id,
            'WIND' => Attribute::where('name', 'wind')->first()->id,
            'FIRE' => Attribute::where('name', 'fire')->first()->id,
            'WATER' => Attribute::where('name', 'water')->first()->id,
            'DIVINE' => Attribute::where('name', 'divine')->first()->id,
        ];

        $races = [
            'dragon' => Race::where('name', 'dragon')->first()->id,
            'spellcaster' => Race::where('name', 'spellcaster')->first()->id,
            'zombie' => Race::where('name', 'zombie')->first()->id,
            'warrior' => Race::where('name', 'warrior')->first()->id,
            'beast-warrior' => Race::where('name', 'beast-warrior')->first()->id,
            'beast' => Race::where('name', 'beast')->first()->id,
            'winged beast' => Race::where('name', 'winged beast')->first()->id,
            'fiend' => Race::where('name', 'fiend')->first()->id,
            'fairy' => Race::where('name', 'fairy')->first()->id,
            'insect' => Race::where('name', 'insect')->first()->id,
            'dinosaur' => Race::where('name', 'dinosaur')->first()->id,
            'reptile' => Race::where('name', 'reptile')->first()->id,
            'fish' => Race::where('name', 'fish')->first()->id,
            'sea serpent' => Race::where('name', 'sea serpent')->first()->id,
            'machine' => Race::where('name', 'machine')->first()->id,
            'thunder' => Race::where('name', 'thunder')->first()->id,
            'aqua' => Race::where('name', 'aqua')->first()->id,
            'pyro' => Race::where('name', 'pyro')->first()->id,
            'rock' => Race::where('name', 'rock')->first()->id,
            'plant' => Race::where('name', 'plant')->first()->id,
            'continous'
        ];

        $types = [
            'Normal Monster' => Type::where('name', 'Normal Monster')->first()->id,
            'Fusion Monster' => Type::where('name', 'Fusion Monster')->first()->id,
            'Ritual Monster' => Type::where('name', 'Ritual Monster')->first()->id,
            'Effect Monster' => Type::where('name', 'Effect Monster')->first()->id,
            'Flip Effect Monster' => Type::where('name', 'Flip Effect')->first()->id,
            'Continuous Effect' => Type::where('name', 'Continuous Effect')->first()->id,
            'Ignition Effect (Cost Effect)' => Type::where('name', 'Ignition Effect (Cost Effect)')->first()->id,
            'Trigger Effect' => Type::where('name', 'Trigger Effect')->first()->id,
            'Multi-Trigger Effect' => Type::where('name', 'Multi-Trigger Effect')->first()->id,
            'Monster Token' => Type::where('name', 'Monster Token')->first()->id,
            'Spell Card' => Type::where('name', 'Spell')->first()->id,
            'Normal Spell' => Type::where('name', 'Normal Spell')->first()->id,
            'Continuous Spell' => Type::where('name', 'Continuous Spell')->first()->id,
            'Equip Spell' => Type::where('name', 'Equip Spell')->first()->id,
            'Field Spell' => Type::where('name', 'Field Spell')->first()->id,
            'Quick-Play Spell' => Type::where('name', 'Quick-Play Spell')->first()->id,
            'Ritual Spell' => Type::where('name', 'Ritual Spell')->first()->id,
            'Trap Card' => Type::where('name', 'Trap')->first()->id,
            'Normal Trap' => Type::where('name', 'Normal Trap')->first()->id,
            'Counter Trap' => Type::where('name', 'Counter Trap')->first()->id,
            'Continuous Trap' => Type::where('name', 'Continuous Trap')->first()->id,
        ];

        $timestamp = Carbon::createFromDate(2005, 12, 31);

        $json = Storage::disk('local')->get('goat-format-cards.json');
        $records = array_values(json_decode($json, true));

        foreach ($records as $cards) {
            foreach ($cards as $card) {
                /** @var Card */
                $newCard = Card::create([
                    'name' => $card['name'],
                    'description' => $card['desc'],
                    'level' => $card['level'] ?? null,
                    'attack' => $card['atk'] ?? null,
                    'defense' => $card['def'] ?? null,
                    'attribute_id' => isset($card['attribute'])  ? $attributes[$card['attribute']] : null,
                    'race_id' => isset($card['race'])  ?  $races[strtolower($card['race'])] : null,
                    'type_id' => $types[$card['type']] ?? null,
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp,
                ]);

                // for ($i = 0; $i < count($card['card_images']); $i++) {
                //     Media::create([
                //         'mediable_id' => $newCard->id,
                //         'mediable_type' => $newCard->getMorphClassName(),
                //         'url' => $card['card_images'][$i]['image_url_cropped'],
                //         'created_at' => $timestamp,
                //         'updated_at' => $timestamp,
                //     ]);
                // }
            }
        }
    }
}
