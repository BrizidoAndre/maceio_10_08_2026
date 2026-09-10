<x-layout>
    <h1>{{$employee->full_name}}</h1>
    <div class="hstack gap-1">
        <a href="{{route('employees.edit', $employee)}}" class="btn btn-secondary">Update</a>
        <a href="{{route('employees.removePhoto', $employee)}}" class="btn btn-secondary">Remove Photo</a>
        <x-form method="delete" action="{{route('employees.destroy', $employee)}}">
            <button class="btn btn-danger">Deactivate</button>
        </x-form>
    </div>
    <hr>
    <div class="row">
        <div class="col-12 col-lg-5">
            <img src="{{asset($employee->getPhoto())}}" alt="The employee face's" class="rounded-3 w-100">
        </div>
        <div class="col-12 col-lg-5">
            <ul class="list-group">
                <li class="list-group-item">
                    Employee_code: {{$employee->employee_code}}
                </li>
                <li class="list-group-item">
                    Full_name: {{$employee->full_name}}
                </li>
                <li class="list-group-item">
                    Email: {{$employee->email}}
                </li>
                <li class="list-group-item">
                    Department: {{$employee->department}}
                </li>
                <li class="list-group-item">
                    Base_salary: {{$employee->base_salary}}
                </li>
                <li class="list-group-item">
                    Employment_start_date: {{$employee->employment_start_date}}
                </li>
                <li class="list-group-item">
                    Status: {{$employee->status}}
                </li>
                <li class="list-group-item">
                    Photo_path: {{$employee->photo_path}}
                </li>
            </ul>
        </div>
    </div>
</x-layout>
