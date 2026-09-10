<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class HolidayRequest extends FormRequest
{
    public function rules()
    {
        $model = request('holiday');
        return [
            'name' => ['required'],
            'date' => ['required', 'date', Rule::unique('public_holidays', 'date')->ignore($model)],
            'description' => ['nullable'],
        ];
    }

    public function messages()
    {
        return [
            'date.unique' => 'A public holiday already exists for this date.'
        ];
    }

    public function authorize()
    {
        return true;
    }
}
