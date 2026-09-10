<x-layout>
    <h1>Update</h1>
    <x-form method="put" action="{{route('employees.update', $employee)}}">
        <x-field name="employee_code" value="{{$employee->employee_code}}">
            Employee Code
        </x-field>
        <x-field name="full_name" value="{{$employee->full_name}}">
            Full name
        </x-field>
        <x-field name="email" type="email" value="{{$employee->email}}">
            Email Address
        </x-field>
        <x-field name="department" value="{{$employee->department}}">
            Department
        </x-field>
        <x-field name="base_salary" value="{{$employee->base_salary}}">
            Base Monthly Salary
        </x-field>
        <x-field name="employment_start_date" type="date" value="{{$employee->employment_start_date->format('Y-m-d')}}">
            Employment Start Date
        </x-field>
        <x-field name="photo_path" type="file">
            Photo
        </x-field>
        <button class="btn btn-primary">Send</button>
    </x-form>
</x-layout>
