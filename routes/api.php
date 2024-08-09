<?php

use App\Http\Controllers\Api\{
    CardController,
    DeckController,
    MediaController,
    StyleController
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/debug', function (Request $request) {
    return response()->json([
        'message' => 'debug',
    ]);
});

Route::get('/ping', function (Request $request) {
    return response()->json([
        'message' => 'pong',
    ]);
});

Route::get('/medias/types', [MediaController::class, 'types']);

Route::apiResource('/cards', CardController::class);
Route::apiResource('/decks', DeckController::class);
Route::apiResource('/medias', MediaController::class);
Route::apiResource('/styles', StyleController::class);
