@php
    $type  = \App\Models\LeaveType::pluck('name','id');
    $employee  = \App\Models\Employee::pluck('full_name','id');
@endphp
<x-layout>
    <h1>Create</h1>
    <x-form action="{{route('leave-requests.store')}}">
        <x-select-field name="employee_id" label="Employee">
            @foreach($employee as $key => $value)
                <option value="{{$key}}">{{$value}}</option>
            @endforeach
        </x-select-field>
        <x-select-field name="leave_type_id" label="Leave type">
            @foreach($type as $key => $value)
                <option value="{{$key}}">{{$value}}</option>
            @endforeach
        </x-select-field>
        <x-field name="start_date" type="date">
            Start date
        </x-field>
        <x-field name="end_date" type="date">
            End date
        </x-field>
        <x-field name="reason">
            Reason
        </x-field>
        <button class="btn btn-primary">Send</button>
    </x-form>
</x-layout>
