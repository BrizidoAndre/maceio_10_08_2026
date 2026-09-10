<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseCombo extends Model
{
    public $timestamps = false;

    public function combo()
    {
        return $this->belongsTo(Combo::class);
    }
}
