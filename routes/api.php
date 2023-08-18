<?php

use App\Http\Controllers\api\ApiAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/ping', function () {
    return ['pong' => true];
});

Route::post('/auth/login', [ApiAuthController::class, 'login'])->name('login');

Route::middleware('auth:api')->group(function () {
    Route::post('/auth/register', [ApiAuthController::class, 'register'])->name('register');
});
