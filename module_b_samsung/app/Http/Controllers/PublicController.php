<?php

namespace App\Http\Controllers;

use App\Models\PublicHoliday;

class PublicController extends Controller
{
    public function index()
    {
        return view('public.index');
    }

    public function holidays()
    {
        $holidays = PublicHoliday
            ::whereYear('date',now())
            ->orderBy('date')
            ->get();
        return view('public.holidays', compact('holidays'));
    }
}
