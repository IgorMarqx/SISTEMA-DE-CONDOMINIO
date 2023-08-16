<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\web\WebAuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WebAuthController::class, 'index'])->name('index_login');
