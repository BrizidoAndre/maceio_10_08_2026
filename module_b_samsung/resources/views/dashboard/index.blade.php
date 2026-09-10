<x-layout>
    <h1>Dashboard</h1>
    <div class="row row-cols-3">
        <div class="col">
            {{--            todo change this urls--}}
            <a href="{{route('employees.index')}}" class="card card-body text-decoration-none">
                <p class="card-title">Active employees</p>
                <p class="fs-2">{{$activeEmployeeCount}}</p>
            </a>
        </div>
        <div class="col">
            <a href="{{route('leave-requests.index')}}" class="card card-body text-decoration-none">
                <p class="card-title">Pending Leave requests</p>
                <p class="fs-2">{{$pendingLeaveRequests}}</p>
            </a>
        </div>
        <div class="col">
            <a href="{{route('payslip.generate')}}" class="card card-body text-decoration-none">
                <p class="card-title">Employees without payslip for current month</p>
                <p class="fs-2">{{$employeesWithoutPayslip}}</p>
            </a>
        </div>
    </div>
</x-layout>
