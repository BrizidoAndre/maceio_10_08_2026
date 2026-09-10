<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');
Route::get('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'loginAction'])->name('loginAction');
Route::get('/signup', [\App\Http\Controllers\AuthController::class, 'signup'])->name('signup');
Route::post('/signup', [\App\Http\Controllers\AuthController::class, 'signupAction'])->name('signupAction');

Route::middleware('auth')->group(function () {
    Route::resource('post', \App\Http\Controllers\PostsController::class);
});
