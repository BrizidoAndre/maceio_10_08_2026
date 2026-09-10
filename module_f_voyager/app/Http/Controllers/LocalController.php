<?php

namespace App\Http\Controllers;

use App\Models\Local;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LocalController extends Controller
{
    public function index()
    {

        return view('local.index');
    }

    public function create()
    {
        return view('local.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'city' => ['required'],
            'country_id' => ['required', 'exists:countries,id'],
            'description' => ['required'],
            'images' => ['array', 'required', 'max:3', 'min:1'],
            'images.*' => ['image',]
        ]);
        $images = $request->file('images');
        unset($data['images']);
        $model = Local::create([
            ...$data,
        ]);
        foreach ($images as $item) {
            $model->images()->create([
                'filepath' => $item->move('countries'),
            ]);
        }
        return redirect()->route('locals.index');
    }

    public function show(Local $local)
    {
    }

    public function edit(Local $local)
    {
        return view('local.edit', compact('local'));
    }

    public function update(Request $request, Local $local)
    {
        $data = $request->validate([
            'city' => ['required'],
            'country_id' => ['required', 'exists:countries,id'],
            'description' => ['required'],
            'images' => ['array', 'max:3', 'min:1'],
            'images.*' => ['image',]
        ]);
        $images = $request->file('images');
        unset($data['images']);
        $local->update([
            ...$data,
        ]);
        if ($request->has('images')) {
            $local->images()->delete();
            foreach ($images as $item) {
                $local->images()->create([
                    'filepath' => $item->move('countries'),
                ]);
            }
        }
        return redirect()->route('locals.index');
    }

    public function destroy(Local $local)
    {
        if ($local->localPackages->count()) {
            throw ValidationException::withMessages([
                'message' => 'This location is associated with other information'
            ]);
        }
        $local->delete();
        return redirect()->route('locals.index');
    }
}
