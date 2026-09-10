<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::query()
            ->get();
        $inactive = Employee
            ::onlyTrashed()
            ->get();
        return view('employee.index', compact('employees', 'inactive'));
    }

    public function create()
    {
        return view('employee.create');
    }

    public function store(EmployeeRequest $request)
    {
        $file = null;
        if ($request->has('photo_path')) {
            $file = $request->file('photo_path')->move('employees_images');
        }
        Employee::create([
            ...$request->validated(),
            'photo_path' => $file,
        ]);
        return redirect()->route('employees.index');
    }

    public function show(Employee $employee)
    {
        return view('employee.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        return view('employee.edit', compact('employee'));
    }

    public function update(EmployeeRequest $request, Employee $employee)
    {
        $file = $employee->photo_path;
        if ($request->has('photo_path')) {
            $file = $request->file('photo_path')->move('employees_images');
        }
        $employee->update([
            ...$request->validated(),
            'photo_path' => $file,
        ]);
        return redirect()->route('employees.index');
    }

    public function destroy(Employee $employee)
    {
        $employee->leaveRequests()->where('status', 'pending')->update(['status' => 'rejected', 'rejection_note' => 'Employee deactivated']);
        $employee->leaveRequests()
            ->where('status', 'approved')
            ->whereAfterToday('start_date')
            ->update(['status' => 'cancelled']);
        $employee->delete();
        return redirect()->route('employees.index');
    }

    public function removePhoto(Employee $employee)
    {
        $employee->update([
            'photo_path' => null,
        ]);
        return redirect()->route('employees.show', $employee);
    }
}
