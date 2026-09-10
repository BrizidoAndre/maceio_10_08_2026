<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\LeaveRequest;
use App\Models\Payslip;

class DashboardController extends Controller
{
    public function index()
    {
        $activeEmployeeCount = Employee::count();
        $pendingLeaveRequests = LeaveRequest::where('status', 'pending')->count();
        $month = now()->format('m');
        $year = now()->format('Y');
        $employeesWithoutPayslip = 5;
        return view('dashboard.index', compact('activeEmployeeCount', 'pendingLeaveRequests', 'employeesWithoutPayslip'));
    }
}
