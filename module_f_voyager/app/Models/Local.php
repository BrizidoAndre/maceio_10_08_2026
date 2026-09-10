<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Local extends Model
{
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(Image::class, 'local_id');
    }

    public function localPackages(): HasMany
    {
        return $this->hasMany(LocalPackage::class, 'local_id');
    }
}
