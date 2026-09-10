<?php

namespace App\Http\Resources;

use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Session */
class SessionResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'movie_id' => $this->movie_id,
            'room_id' => $this->room_id,
            'session_date' => $this->session_date,
            'movie' => new MovieSessionResource($this->whenLoaded('movie')),
            'room' => new RoomSessionResource($this->whenLoaded('room')),
        ];
    }
}
