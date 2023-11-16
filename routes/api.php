<?php

use App\Http\Controllers\auth\ApiAuthController;
use App\Http\Controllers\dashboard\ApiApartmentController;
use App\Http\Controllers\dashboard\ApiAreaController;
use App\Http\Controllers\dashboard\ApiCondominiumController;
use App\Http\Controllers\dashboard\ApiGarageController;
use App\Http\Controllers\filter\CondominiumFilterController;
use App\Http\Controllers\filter\UserFilterController;
use App\Http\Controllers\user\ApiUserController;
use Illuminate\Support\Facades\Route;

Route::get('/ping', function () {
    return ['pong' => true];
});

Route::get('unauthorized', function () {
    return response()->json(['error' => 'Unauthorized'], 401);
})->name('api.unauthorized');

Route::post('/auth/login', [ApiAuthController::class, 'login']);

Route::middleware(['api.auth'])->group(function () {
    Route::post('/auth/register', [ApiAuthController::class, 'register']);

    Route::get('/filter/users', [UserFilterController::class, 'filterUser']);
    Route::get('/filter/condominium', [CondominiumFilterController::class, 'filterCondominium']);

    Route::apiResources([
        'users' => ApiUserController::class,
        'condominium' => ApiCondominiumController::class,
        'areas' => ApiAreaController::class,
        'apartment' => ApiApartmentController::class,
        'garage' => ApiGarageController::class,
    ]);
});
