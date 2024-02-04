<?php

use App\Http\Controllers\RoleController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware(['jwt.auth'])->group(function () {
    Route::get('auth', fn() => auth()->user());
    Route::resource('role', RoleController::class)->middleware('role:Admin')->only(['index', 'show', 'store', 'update', 'destroy']);
    Route::resource('user', UserController::class)->only(['index', 'show', 'store', 'update', 'destroy']);
    Route::resource('transaction', TransactionController::class)->only(['index', 'show']);
    Route::resource('user/{user}/transaction', TransactionController::class)->only(['store', 'destroy']);
});
