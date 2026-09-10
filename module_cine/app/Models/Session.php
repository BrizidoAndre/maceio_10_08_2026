<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $table = 'sessions';
    public $timestamps = false;

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class, 'session_id');
    }

    public function getAvailability()
    {
        $seats = $this->room->seats()->get();
        $purchasedSeats = $this->purchases()->get()->flatMap(function (Purchase $p) {
            return $p->purchaseSeats;
        });
        return $seats->map(function (Seat $seat) use ($purchasedSeats) {
            return [
                'seat' => $seat->seat_code,
                'available' => !$purchasedSeats->some(function (PurchaseSeat $purchaseSeat) use ($seat) {
                    return $purchaseSeat->seat_id === $seat->id;
                }),
            ];
        });
    }
}
