<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use SoftDeletes;

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
        ];
    }

    public function localPackages(): HasMany
    {
        return $this->hasMany(LocalPackage::class, 'package_id');
    }

    public function purchases(): HasMany
    {
        return $this->hasMany(Purchase::class, 'package_id');
    }
}
