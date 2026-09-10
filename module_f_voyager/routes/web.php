<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\LocalController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

//public routes

Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/register', [AuthController::class, 'registerAction'])->name('auth.registerAction');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginAction'])->name('auth.loginAction');

Route::middleware('auth:web')->group(function () {
//    logout
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    //    registering partners
    Route::get('/admin/register/workers', [AuthController::class, 'registerSaleperson'])->name('register.workers');
    Route::post('/admin/register/workers', [AuthController::class, 'registerSalepersonAction'])->name('register.workers.actionl');
    Route::get('/admin/register/partner', [AuthController::class, 'registerPartner'])->name('register.partner');
    Route::post('/admin/register/partner', [AuthController::class, 'registerPartnerAction'])->name('register.partner-action');
});

Route::resource('locals', LocalController::class)->middleware('auth:web');
Route::resource('packages', PackageController::class)->middleware('auth:partners');
Route::resource('discounts', DiscountController::class)->middleware('auth:web');
Route::get('/package/buy', [PackageController::class, 'buy'])->middleware('auth:customers')->name('package.buy');

