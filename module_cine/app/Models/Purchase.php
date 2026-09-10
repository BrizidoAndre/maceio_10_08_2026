<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    public $timestamps = false;

    public function purchaseSeats()
    {
        return $this->hasMany(PurchaseSeat::class, 'purchase_id');
    }

    public function purchaseCombos()
    {
        return $this->hasMany(PurchaseCombo::class, 'purchase_id');
    }

    public function cashbacks()
    {
        return $this->hasMany(Cashback::class, 'purchase_id');
    }

    protected function casts()
    {
        return [
            'purchased_at' => 'datetime'
        ];
    }
}
