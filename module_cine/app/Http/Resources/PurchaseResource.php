<?php

namespace App\Http\Resources;

use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Purchase */
class PurchaseResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'customer_id' => $this->customer_id,
            'session_id' => $this->session_id,
            'subtotal' => $this->subtotal,
            'total' => $this->total,
            'wallet_amount' => $this->wallet_amount,
            'card_amount' => $this->card_amount,
            'cashback_amount' => $this->cashback_amount,
            'status' => $this->status,
            'purchased_at' => $this->purchased_at,
            'seats' => $this->purchaseSeats,
        ];
    }
}
