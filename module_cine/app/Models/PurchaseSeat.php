<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseSeat extends Model
{
    public $timestamps = false;

    public function seat()
    {
        return $this->belongsTo(Seat::class);
    }
}
