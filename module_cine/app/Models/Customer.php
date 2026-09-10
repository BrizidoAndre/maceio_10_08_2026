<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    public $timestamps = false;

    protected function casts()
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function cashbacks()
    {
        return $this->hasMany(Cashback::class, 'customer_id');
    }
}
