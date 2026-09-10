<?php

namespace App\Http\Controllers;

use App\Http\Requests\HolidayRequest;
use App\Models\PublicHoliday;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
    public function index()
    {
        $holidays = PublicHoliday
            ::query()
            ->orderBy('date')
            ->get();
        return view('holiday.index', compact('holidays'));
    }

    public function create()
    {
        return view('holiday.create');
    }

    public function store(HolidayRequest $request)
    {
        PublicHoliday::create($request->validated());
        return redirect()->route('holidays.index');
    }

    public function show(PublicHoliday $publicHoliday)
    {

    }

    public function edit(PublicHoliday $holiday)
    {
        return view('holiday.edit', compact('holiday'));
    }

    public function update(HolidayRequest $request, PublicHoliday $holiday)
    {
        $holiday->update($request->validated());
        return redirect()->route('holidays.index');
    }

    public function destroy(PublicHoliday $holiday)
    {
        return redirect()->route('holidays.index');
    }
}
