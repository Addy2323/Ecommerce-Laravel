<?php

use Illuminate\Support\Facades\Route;

Route::get('/test-key', function () {
    return response()->json([
        'app_key' => env('APP_KEY')
    ]);
});
