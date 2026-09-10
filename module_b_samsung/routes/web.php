<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\TaxBracketController;
use Illuminate\Support\Facades\Route;

// public
Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/public/holidays', [PublicController::class, 'holidays'])->name('public.holidays');

// auth management routes
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginAction'])->name('loginAction');

//authenticated routes
Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

//    employees
    Route::resource('employees', EmployeeController::class);
    Route::get('employees/remove-photo/{employee}', [EmployeeController::class, 'removePhoto'])->name('employees.removePhoto');

//    public holidays
    Route::resource('holidays', HolidayController::class);

//    tax brackets
    Route::resource('tax-brackets', TaxBracketController::class);

//    leave requests
    Route::resource('leave-requests', LeaveRequestController::class);
    Route::get('leave-requests/{leaveRequest}/approve', [LeaveRequestController::class, 'approve'])->name('leave-request.approve');
    Route::get('leave-requests/{leaveRequest}/reject', [LeaveRequestController::class, 'reject'])->name('leave-request.reject');
    Route::get('leave-requests/{leaveRequest}/cancel', [LeaveRequestController::class, 'cancel'])->name('leave-request.cancel');


//    paylisps
    Route::get('payslips', [\App\Http\Controllers\PayslipController::class, 'index'])->name('payslip.index');
    Route::get('payslips/generate', [\App\Http\Controllers\PayslipController::class, 'generate'])->name('payslip.generate');
});
