<x-layout>
    <div class="hstack justify-content-between">
        <h1>Employees</h1>
        <a href="{{route('employees.create')}}" class="btn btn-success">Create</a>
    </div>
    <hr>
    <table class="table">
        <thead>
        <tr>
            <th>Image</th>
            <th>Code</th>
            <th>Name</th>
        </tr>
        </thead>
        <tbody>
        @foreach($employees as $employee)
            <tr>
                <td>
                    <img src="{{asset($employee->getPhoto())}}" alt="Employee's portrait" width="150">
                </td>
                <td>
                    <a href="{{route('employees.show', $employee)}}">
                        {{$employee->employee_code}}
                    </a>
                </td>
                <td>{{$employee->full_name}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <h2>Inactive Employees</h2>
    <table class="table">
        <thead>
        <tr>
            <th>Image</th>
            <th>Code</th>
            <th>Name</th>
        </tr>
        </thead>
        <tbody>
        @foreach($inactive as $employee)
            <tr>
                <td>
                    <img src="{{asset($employee->getPhoto())}}" alt="Employee's portrait" width="150">
                </td>
                <td>
                    {{$employee->employee_code}}
                </td>
                <td>{{$employee->full_name}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</x-layout>
