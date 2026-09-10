<x-layout>
    <h1>{{$leaveRequest->employee->full_name}}</h1>
    <div>
        @if($leaveRequest->status === 'pending')
            <a href="{{route('leave-request.approve', $leaveRequest)}}" class="btn btn-primary">Approve request</a>
            <a href="{{route('leave-request.reject', $leaveRequest)}}" class="btn btn-danger">Reject Request</a>
        @endif
        @if($leaveRequest->start_date->isBefore(now()))
            <a href="{{route('leave-request.cancel', $leaveRequest)}}" class="btn btn-secondary">Cancel request</a>
        @endif
    </div>
    <hr>
    <div class="row">
        <div class="col-12 col-lg-5">
            <img src="{{asset($leaveRequest->employee->photo_path)}}" alt="Employee's portrait">
        </div>
        <div class="col-12 col-lg-5">
            <ul class="list-group">
                <li class="list-group-item">
                    start_date: {{ $leaveRequest->start_date }}
                </li>
                <li class="list-group-item">
                    end_date: {{ $leaveRequest->end_date }}
                </li>
                <li class="list-group-item">
                    reason: {{ $leaveRequest->reason }}
                </li>
                <li class="list-group-item">
                    status: {{ $leaveRequest->status }}
                </li>
                <li class="list-group-item">
                    effective_days: {{ $leaveRequest->effective_days }}
                </li>
                <li class="list-group-item">
                    rejection_note: {{ $leaveRequest->rejection_note }}
                </li>
                <li class="list-group-item">
                    processed_at: {{ $leaveRequest->processed_at }}
                </li>
            </ul>
        </div>
    </div>
</x-layout>
