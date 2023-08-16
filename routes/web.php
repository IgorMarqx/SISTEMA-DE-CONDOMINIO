<?php

use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('login', [HomeController::class, 'login_action'])->name('login_action');
