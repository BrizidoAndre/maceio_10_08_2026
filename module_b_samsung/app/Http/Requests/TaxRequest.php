<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaxRequest extends FormRequest
{
    public function rules()
    {
        return [
            'lower_bound' => ['required', 'integer', 'min:0'],
            'upper_bound' => ['nullable', 'integer', 'gt:lower_bound'],
            'rate_percent' => ['required', 'decimal:2', 'min:0', 'max:100'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
