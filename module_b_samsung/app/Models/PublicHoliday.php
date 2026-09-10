<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PublicHoliday extends Model
{
    protected function casts()
    {
        return [
            'date' => 'date',
        ];
    }
}
