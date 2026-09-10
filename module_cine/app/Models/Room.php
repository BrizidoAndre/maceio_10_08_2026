<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public $timestamps = false;

    public function seats()
    {
        return $this->hasMany(Seat::class, 'room_id');
    }
}
