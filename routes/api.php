<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/debug', function(Request $request) {
    return response()->json([
        // code
    ]);
});

Route::get('/ping', function(Request $request) {
    return response()->json([
        'message' => 'pong',
    ]);
});
