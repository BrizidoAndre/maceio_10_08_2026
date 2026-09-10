<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComboController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SessionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// public
// sign in methods
Route::post('/login', [AuthController::class, 'login']);
Route::post('/customers', [AuthController::class, 'register']);


//authenticated
Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

//    movies
    Route::get('movies', [MovieController::class, 'index']);
    Route::get('movies/{movie}', [MovieController::class, 'show']);

//    combos
    Route::get('/combos', [ComboController::class, 'index']);

//    sessions
    Route::get('sessions', [SessionController::class, 'index']);
    Route::post('sessions', [SessionController::class, 'store']);

//    seats management
    Route::get('sessions/{session}/seats', [SessionController::class, 'seats']);
    Route::get('sessions/{session}/seats/stream', [SessionController::class, 'stream']);

//    purchases
    Route::get('purchases', [PurchaseController::class, 'index']);
    Route::post('purchases', [PurchaseController::class, 'store']);
    Route::get('wallet', [PurchaseController::class, 'wallet']);
});
