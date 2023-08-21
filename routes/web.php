<?php

use App\Http\Controllers\web\WebAuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WebAuthController::class, 'index'])->name('index_login');

// Route::middleware('auth')->group(function () {
    Route::get('/home', [WebAuthController::class, 'home'])->name('home');
// });
