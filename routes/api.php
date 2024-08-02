<?php

use App\Http\Controllers\Api\CardController;
use App\Models\Type;
use App\Models\Race;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/debug', function (Request $request) {
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
        'Normal Spell Card' => Type::where('name', 'Normal Spell')->first()->id,
        'Continuous Spell Card' => Type::where('name', 'Continuous Spell')->first()->id,
        'Equip Spell Card' => Type::where('name', 'Equip Spell')->first()->id,
        'Field Spell Card' => Type::where('name', 'Field Spell')->first()->id,
        'Quick-Play Spell Card' => Type::where('name', 'Quick-Play Spell')->first()->id,
        'Ritual Spell Card' => Type::where('name', 'Ritual Spell')->first()->id,
        'Trap Card' => Type::where('name', 'Trap')->first()->id,
        'Normal Trap Card' => Type::where('name', 'Normal Trap')->first()->id,
        'Counter Trap Card' => Type::where('name', 'Counter Trap')->first()->id,
        'Continuous Trap Card' => Type::where('name', 'Continuous Trap')->first()->id,
    ];

    $card['type'] = 'Spell Card';
    $card['race'] = 'Continuous';

    $name = $card['type'];
        if (empty($name))
            return null;

        $name = (! in_array(strtolower($card['race']), array_keys($races))) 
            ? $types[$card['race'] . ' ' . $card['type']] 
            : $types[$card['type']] ?? $card['type'];

        if (gettype($name) == 'integer')
            return [$name];

        $name = explode(' ', preg_replace('/ Monster/', '', $name));
        $name = array_map(function($item) {
            $tmp = Type::where('name', $item . ' Monster')->first()->id ?? null;

            return $tmp;
        }, $name);

        $name = array_values(array_filter($name, function($item) {
            if (isset($item))
                return $item;
        }));
    return response()->json([
        'message' => $name,
    ]);
});

Route::get('/ping', function (Request $request) {
    return response()->json([
        'message' => 'pong',
    ]);
});

Route::apiResource('/cards', CardController::class);
