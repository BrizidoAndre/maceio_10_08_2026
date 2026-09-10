<?php

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Route;

Route::get('employees/{employee}/leave-balance', [ApiController::class, 'index']);
