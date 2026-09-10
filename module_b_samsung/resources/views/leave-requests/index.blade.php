@php
    $types = [
        'pending' => 'text-bg-secondary',
        'approved' => 'text-bg-success',
        'rejected' => 'text-bg-danger',
        'cancelled' => 'text-bg-secondary opacity-50',
];
    $employees = \App\Models\Employee::pluck('full_name','id');
@endphp
<x-layout>
    <h1>Leave requests</h1>
    <a href="{{route('leave-requests.create')}}" class="btn btn-success">Create</a>
    <table class="table">
        <thead>
        <tr>
            <th>Status</th>
            <th>Employee</th>
            <th>Reason</th>
            <th>Schedule label</th>
        </tr>
        <form action="">
            <tr>
                <th>
                    <x-select-field name="status">
                        @foreach(array_keys($types) as $key)
                            <option @selected($key == request('status')) value="{{$key}}">{{$key}}</option>
                        @endforeach
                    </x-select-field>
                </th>
                <th>
                    <x-select-field name="employee_id">
                        @foreach($employees as $key => $value)
                            <option @selected($key == request('employee_id')) value="{{$key}}">{{$value}}</option>
                        @endforeach
                    </x-select-field>
                </th>
                <th>
                    <button class="btn btn-secondary">Search</button>
                </th>
                <th></th>
            </tr>
        </form>
        </thead>
        <tbody>
        @foreach($models as $model)
            <tr>
                <td>
                    <span class="badge {{$types[$model->status]}}">{{$model->status}}</span>
                </td>
                <td>
                    @if($model->employee)
                        <a href="{{route('leave-requests.show', $model)}}">
                            {{$model->employee?->full_name }}
                        </a>
                    @else
                        <span class="opacity-50">Employee deactivated!</span>
                    @endif
                </td>
                <td>
                    {{$model->reason}}
                </td>
                <td>
                    {{$model->showLabel()}}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</x-layout>
