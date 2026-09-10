<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cashback extends Model
{
    public $timestamps = false;

    protected $table = 'cashback';

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

    protected function casts()
    {
        return [
            'expires_at' => 'date',
        ];
    }
}
