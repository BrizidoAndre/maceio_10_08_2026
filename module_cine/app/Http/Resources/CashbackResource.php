<?php

namespace App\Http\Resources;

use App\Models\Cashback;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Cashback */
class CashbackResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'amount' => $this->amount,
            'expires_at' => $this->expires_at->format('Y-m-d'),
        ];
    }
}
