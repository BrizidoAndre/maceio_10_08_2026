<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    public $timestamps = false;

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function purchaseSeats()
    {
        return $this->hasMany(PurchaseSeat::class, 'seat_id');
    }
}
