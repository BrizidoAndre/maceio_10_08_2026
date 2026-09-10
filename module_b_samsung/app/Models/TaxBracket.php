<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;

class TaxBracket extends Model
{
    public static function isInvalid()
    {
        $taxBrackets = TaxBracket::orderBy('lower_bound')->get();
        if ($taxBrackets->isEmpty()) {
            return false;
        }
        $first = $taxBrackets->first();
        if ($first->lower_bound !== 0) {
            throw ValidationException::withMessages([
                'lower_bound' => 'Tax brackets must be gapless and non-overlapping.'
            ]);
        }
        for ($i = 0; $i < $taxBrackets->count() - 1; $i++) {
            $current = $taxBrackets->get($i);
            $next = $taxBrackets->get($i + 1);
            if ($current->upper_bound !== $next->lower_bound) {
                throw ValidationException::withMessages([
                    'lower_bound' => 'Tax brackets must be gapless and non-overlapping.'
                ]);
            }
        }
        return false;
    }
}
