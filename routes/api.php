<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/debug', function(Request $request) {
    $json = Storage::disk('local')->get('goat-format-cards.json');
    $records = array_values(json_decode($json, true));

    foreach ($records as $cards) {
        return response()->json($cards[2]);

        foreach ($cards as $card) {
            return response()->json($card);
        }
    }
    // return response()->json($cards);
});
