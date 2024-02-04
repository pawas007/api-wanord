<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use Illuminate\Support\Facades\Route;

Route::post('login', [LoginController::class, 'login']);

Route::middleware(['jwt.auth'])->group(function () {
    Route::post('logout', [LogoutController::class, 'logout']);
});


