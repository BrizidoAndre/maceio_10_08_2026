<?php

namespace App\Http\Controllers;

use App\Http\Requests\LeaveRequestRequest;
use App\Models\Employee;
use App\Models\LeaveRequest;
use App\Models\PublicHoliday;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class LeaveRequestController extends Controller
{
    public function index()
    {
        $models = LeaveRequest
            ::query()
            ->when(request('status'), function (Builder $query, $v) {
                $query->where('status', $v);
            })
            ->when(request('employee_id'), function (Builder $query, $v) {
                $query->where('employee_id', $v);
            })
            ->get();
        return view('leave-requests.index', compact('models'));
    }

    public function create()
    {
        return view('leave-requests.create');
    }

    public function store(LeaveRequestRequest $request)
    {
        $effectiveDays = LeaveRequest::calcEffectiveDays(request('start_date'), request('end_date'));

        LeaveRequest::create([
            ...$request->validated(),
            'effective_days' => $effectiveDays,
        ]);
        return redirect()->route('leave-requests.index');
    }

    public function show(LeaveRequest $leaveRequest)
    {
        return view('leave-requests.show', compact('leaveRequest'));
    }

    public function edit(LeaveRequest $leaveRequest)
    {
    }

    public function update(LeaveRequestRequest $request, LeaveRequest $leaveRequest)
    {

        return redirect()->route('leave-requests.index');
    }

    public function destroy(LeaveRequest $leaveRequest)
    {

        return redirect()->route('leave-requests.index');
    }

    public function approve(LeaveRequest $leaveRequest)
    {
        $leaveRequest->update([
            'status' => 'approved',
        ]);
        return redirect()->route('leave-requests.index');
    }

    public function reject(LeaveRequest $leaveRequest)
    {
        $leaveRequest->update([
            'status' => 'rejected',
        ]);
        return redirect()->route('leave-requests.index');
    }

    public function cancel(LeaveRequest $leaveRequest)
    {
        $leaveRequest->update([
            'status' => 'cancelled',
        ]);
        return redirect()->route('leave-requests.index');
    }
}
