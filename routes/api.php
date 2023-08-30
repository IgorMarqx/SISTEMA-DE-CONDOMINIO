<?php

use App\Http\Controllers\api\ApiAuthController;
use App\Http\Controllers\user\ApiUserController;
use Illuminate\Support\Facades\Route;

Route::get('/ping', function () {
    return ['pong' => true];
});

Route::get('unauthorized', function () {
    return response()->json(['error' => 'Unauthorized'], 401);
})->name('api.unauthorized');

Route::post('/auth/login', [ApiAuthController::class, 'login']);

Route::post('/auth/register', [ApiAuthController::class, 'register']);
Route::middleware(['api.auth'])->group(function () {

    Route::get('/users/{id}/edit', [ApiUserController::class, 'edit']);
    Route::apiResources([
        'users' => ApiUserController::class
    ]);
});
