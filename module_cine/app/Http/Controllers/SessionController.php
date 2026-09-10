<?php

namespace App\Http\Controllers;

use App\Http\Resources\SessionResource;
use App\Models\Purchase;
use App\Models\PurchaseCombo;
use App\Models\PurchaseSeat;
use App\Models\Seat;
use App\Models\Session;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\StreamedEvent;
use Illuminate\Support\Js;

class SessionController extends Controller
{
    // getting every session
    public function index()
    {
        $models = Session
            ::with(['room', 'movie'])
            ->when(request()->query('movie'), function (Builder $query, $v) {
                $query->where('movie_id', $v);
            })
            ->when(request()->query('room'), function (Builder $query, $v) {
                $query->where('room_id', $v);
            })
            ->when(request()->query('date'), function (Builder $query, $v) {
                $date = Carbon::createFromFormat('Y-m-d', $v);
                $query->whereDate('session_date', $date);
            })
            ->get();
        return SessionResource::collection($models);
    }

    // creating a new session
    public function store(Request $request)
    {
        $data = $request->validate([
            'movie_id' => ['required', 'exists:movies,id'],
            'room_id' => ['required', 'exists:rooms,id'],
            'session_date' => ['required', 'date_format:Y-m-d H:i']
        ]);
        $model = Session::create($data);
        $model->load(['movie', 'room']);
        return SessionResource::make($model);
    }

//    getting availability based on seat
    public function seats(Session $session)
    {
        $available = $session->getAvailability();
        return $available;
    }

//    stream event for availability
    public function stream(Session $session)
    {
        return response()->stream(function () use ($session) {
            while (true) {
                if (connection_aborted()) {
                    break;
                }

                $event = 'seats';

                $message = Js::encode([
                    'session_id' => $session->id,
                    'seats' => $session->getAvailability(),
                ]);

                echo "event: $event\n";
                echo 'data: ' . $message;
                echo "\n\n";

                if (ob_get_level() > 0) {
                    ob_flush();
                }

                sleep(1);
                flush();
            }
        }, 200, array_merge([
            'Content-Type' => 'text/event-stream',
            'Cache-Control' => 'no-cache',
            'X-Accel-Buffering' => 'no',
        ]));
    }
}
