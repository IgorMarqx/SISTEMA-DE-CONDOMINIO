<?php

use App\Http\Controllers\api\ApiAuthController;
use App\Http\Controllers\user\ApiUserController;
use Illuminate\Support\Facades\Route;

Route::get('/ping', function () {
    return ['pong' => true];
});

Route::post('/auth/login', [ApiAuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::post('/auth/register', [ApiAuthController::class, 'register']);

    Route::get('/users/{id}/edit', [ApiUserController::class, 'edit']);
    Route::apiResources([
        'users' => ApiUserController::class
    ]);
});
