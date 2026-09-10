<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmployeeRequest extends FormRequest
{
    public function rules()
    {
        $employee = request('employee');
        return [
            'employee_code' => ['required', 'regex:/^[A-Z]{3}\d{3}$/', Rule::unique('employees','employee_code')->ignore($employee)],
            'full_name' => ['required'],
            'email' => ['required', 'email', 'max:254', Rule::unique('employees','email')->ignore($employee)],
            'department' => ['required'],
            'base_salary' => ['required', 'integer', 'min:1'],
            'employment_start_date' => ['required', 'date'],
            'photo_path' => ['nullable', 'image', 'mimes:png,jpeg,jpg', 'max:1024'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
