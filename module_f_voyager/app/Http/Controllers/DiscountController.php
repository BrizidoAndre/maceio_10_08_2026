<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class DiscountController extends Controller
{
    public function index()
    {
        return view('discount.index');
    }

    public function create()
    {
        return view('discount.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'package_id' => ['required'],
            'min_people' => ['required_without_all:start_date,end_date', 'nullable', 'integer', 'min:1'],
            'discount' => ['required', 'integer', 'min:5',],
            'start_date' => ['nullable', 'required_without:min_people', 'date',],
            'end_date' => ['nullable', 'required_without:min_people', 'date', 'after:start_date'],
        ]);
        if ($request->filled('min_people')) {
            if ((int)$data['discount'] > 15) {
                throw ValidationException::withMessages([
                    'start_date' => 'The percentage must be below 15%'
                ]);
            }
        }
        if ($request->filled('start_date')) {
            $start = Carbon::createFromFormat('Y-m-d', $data['start_date']);
            $end = Carbon::createFromFormat('Y-m-d', $data['end_date']);
            $dif = $start->diffInDays($end);
            if ($dif > 5 || $dif < 2) {
                throw ValidationException::withMessages([
                    'start_date' => 'The validity period must be between 2 and 5 days'
                ]);
            }
            if ((int)$data['discount'] > 20) {
                throw ValidationException::withMessages([
                    'start_date' => 'The percentage must be below 20%'
                ]);
            }
        }
        $model = Discount::create([
            ...$data,
        ]);
        return redirect()->route('discounts.index');
    }

    public function show(Discount $discount)
    {
    }

    public function edit(Discount $discount)
    {
    }

    public function update(Request $request, Discount $discount)
    {
    }

    public function destroy(Discount $discount)
    {
    }
}
