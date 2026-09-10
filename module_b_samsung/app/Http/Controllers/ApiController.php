<?php

namespace App\Http\Controllers;

use App\Models\Employee;

class ApiController extends Controller
{
    public function index(Employee $employee)
    {
        $year = now()->format('Y');
        $effectiveAnnual = $employee->leaveRequests->where('leave_type_id', 1)->sum('effective_days');
        $effectiveSick = $employee->leaveRequests->where('leave_type_id', 2)->sum('effective_days');
        return [
            'employee' => [
                'id' => $employee->id,
                'name' => $employee->full_name,
                'code' => $employee->employee_code,
                'department' => $employee->department,
                'status' => (bool)$employee->deactivated_at ? 'inactive': 'active',
            ],
            'year' => $year,
            'leaveBalance' => [
                [
                    'leaveType' => [
                        'id' => 1,
                        'name' => 'Annual Leave',
                    ],
                    'annualQuota' => 12,
                    'used' => $effectiveAnnual,
                    'remaining' => 12 - $effectiveAnnual
                ],
                [
                    'leaveType' => [
                        'id' => 2,
                        'name' => 'Sick Leave',
                    ],
                    'annualQuota' => 12,
                    'used' => $effectiveSick,
                    'remaining' => 12 - $effectiveSick
                ],
            ]
        ];
    }
}
