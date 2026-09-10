<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaxRequest;
use App\Models\TaxBracket;
use Illuminate\Http\Request;

class TaxBracketController extends Controller
{
    public function index()
    {
        $models = TaxBracket
            ::query()
            ->get();
        return view('tax.index', compact('models'));
    }

    public function create()
    {
        return view('tax.create');
    }

    public function store(TaxRequest $request)
    {
        \DB::transaction(function () use ($request) {
            TaxBracket::create($request->validated());
            TaxBracket::isInvalid();
        });
        return redirect()->route('tax-brackets.index');
    }

    public function show(TaxBracket $taxBracket)
    {
    }

    public function edit(TaxBracket $taxBracket)
    {
        return view('tax.edit', compact('taxBracket'));
    }

    public function update(TaxRequest $request, TaxBracket $taxBracket)
    {
        \DB::transaction(function () use ($request, $taxBracket) {
            $taxBracket->update($request->validated());
            TaxBracket::isInvalid();
        });
        return redirect()->route('tax-brackets.index');
    }

    public function destroy(TaxBracket $taxBracket)
    {
        \DB::transaction(function () use ($taxBracket) {
            $taxBracket->delete();
            TaxBracket::isInvalid();
        });
        return redirect()->route('tax-brackets.index');
    }
}
