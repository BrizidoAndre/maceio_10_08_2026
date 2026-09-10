<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    protected $table = 'customers';

    protected function casts(): array
    {
        return [
            'birthday' => 'date',
            'password' => 'hashed',
        ];
    }

    public function customerPurchase(): HasOne
    {
        return $this->hasOne(CustomerPurchase::class, 'customers_id');
    }

    public function dependants(): HasMany
    {
        return $this->hasMany('customers', 'customer_id', 'id');
    }

    public function principal(): HasOne
    {
        return $this->hasOne('customers', 'id', 'customer_id');
    }
}
