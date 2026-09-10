<x-layout>
    <h1>Create</h1>
    <x-form action="{{route('employees.store')}}">
        <x-field name="employee_code">
            Employee Code
        </x-field>
        <x-field name="full_name">
            Full name
        </x-field>
        <x-field name="email" type="email">
            Email Address
        </x-field>
        <x-field name="department">
            Department
        </x-field>
        <x-field name="base_salary">
            Base Monthly Salary
        </x-field>
        <x-field name="employment_start_date" type="date">
            Employment Start Date
        </x-field>
        <x-field name="photo_path" type="file">
            Photo
        </x-field>
        <button class="btn btn-primary">Send</button>
    </x-form>
</x-layout>
