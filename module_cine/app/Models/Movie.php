<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    public $timestamps = false;

    protected function casts()
    {
        return [
            'release_date' => 'date',
            'in_theaters' => 'boolean',
        ];
    }
}
