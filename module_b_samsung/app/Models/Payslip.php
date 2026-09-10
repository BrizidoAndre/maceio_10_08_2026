<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payslip extends Model
{
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    protected function casts()
    {
        return [
            'generated_at' => 'timestamp',
        ];
    }
}
