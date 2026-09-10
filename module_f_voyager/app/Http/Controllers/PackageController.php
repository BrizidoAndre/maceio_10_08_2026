<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        return view('package.index');
    }

    public function create()
    {
        return view('package.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required',],
            'description' => ['required',],
            'price' => ['required',],
            'start_date' => ['required', 'date',],
            'end_date' => ['required', 'date', 'after:start_date'],
            'minimum_people' => ['required',],
            'maximum_people' => ['required', 'gt:minimum_people'],
            'locations' => ['required', 'min:1', 'max:3'],
            'locations.*' => ['required', 'exists:locals,id'],
        ]);
        $locals = $data['locations'];
        unset($data['locations']);
        $model = Package::create([
            ...$data,
            'partner_id' => auth()->id(),
        ]);
        foreach ($locals as $local) {
            $model->localPackages()->create([
                'local_id' => $local,
            ]);
        }
        return redirect()->route('packages.index');
    }

    public function show(Package $package)
    {
    }

    public function edit(Package $package)
    {
    }

    public function update(Request $request, Package $package)
    {
    }

    public function destroy(Package $package)
    {
        if ($package->purchases->count()) {
            $package->delete();
        } else {
            $package->forceDelete();
        }
        return redirect()->route('packages.index');
    }

    public function buy()
    {
        return view('package.buy');
    }
}
