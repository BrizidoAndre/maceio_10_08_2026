<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Http\Resources\CashbackResource;
use App\Http\Resources\IndexPurchaseResource;
use App\Http\Resources\PurchaseResource;
use App\Models\Combo;
use App\Models\Purchase;
use App\Models\Room;
use App\Models\Seat;
use App\Models\Session;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class PurchaseController extends Controller
{
//    reading all purchases
    public function index()
    {
        $models = Purchase::all();
        return IndexPurchaseResource::collection($models);
    }

//    creating a puchase
    public function store(Request $request)
    {
        $session = Session::findOrFail(request('session_id'));
        $seatsCode = [];
        if ($session) {
            $seatsCode = $session->room->seats()->pluck('seat_code');
        }
        $data = $request->validate([
            'session_id' => ['required', 'exists:sessions,id'],
            'seats' => ['required', 'array'],
            'seats.*' => ['required', 'string', Rule::in($seatsCode)],
            'combos' => ['array'],
            'combos.*.combo_id' => ['required', 'exists:combos,id'],
            'combos.*.quantity' => ['required', 'integer', 'min:1'],
            'wallet_amount' => ['required', 'min:0'],
            'card' => ['required'],
            'card.number' => ['required', 'string', 'size:16'],
            'card.holder' => ['required', 'string'],
            'card.expiration' => ['required', 'date_format:m/y'],
            'card.cvv' => ['required', 'integer', 'digits:3']
        ]);
        $session = Session::find($data['session_id']);
//        checking setting validation
        $available = collect($session->getAvailability());
        $seats = $available->filter(fn($a) => in_array($a['seat'], $data['seats']));
        $isAvailable = !$seats->some(fn($s) => !$s['available']);
        if (!$isAvailable) {
            throw ValidationException::withMessages([
                'seats' => 'Unavailable seat'
            ]);
        }

        $setting = Setting::first();
        $room = $session->room;

//        getting seats to create in this purchase after
        $seats = Seat
            ::whereIn('seat_code', $data['seats'])
            ->where('room_id', $session->room_id)
            ->get();
//        getting combos to create in this purchase after
        $comboPost = collect($data['combos'])->map(fn($c) => $c['combo_id']);
        $combos = Combo::whereIn('id', $comboPost)->get();

//       // getting price values;
        $ticketPrice = $room->type === 'vip' ? $setting->vip_ticket_price : $setting->normal_ticket_price;
        $totalTicket = $ticketPrice * collect($data['seats'])->count();
        $totalCombos = 0;
        foreach ($combos as $key => $combo) {
            $comboData = collect($data['combos'])->first(fn($c) => $c['combo_id'] === $combo->id);
            $quantity = $comboData['quantity'];
            $totalCombos += $quantity * $combo->price;
        }
        $totalOrdered = $totalTicket + $totalCombos;

//        array for creation purposes
        $create = collect($data)->only([
            'customer_id',
            'session_id',
            'wallet_amount',
            'cashback_amount',
        ]);
        $create['customer_id'] = auth()->id();
        $create['subtotal'] = $create['wallet_amount'];
        $create['total'] = $totalOrdered;
        $create['purchased_at'] = now();
        $create['card_amount'] = max($totalOrdered - $create['wallet_amount'], 0);
        $create['cashback_amount'] = $create['card_amount'] / $setting->cashback_percent;

//        making sure the payment is proceeded
        if ($create['card_amount'] > 0) {
            $purchase = \Http::post('http://172.27.0.1:3100/api/payments', [
                'amount' => $create['card_amount'],
                'card' => $data['card']
            ]);
            $purchaseApiSuccess = $purchase->ok();
            if (!$purchaseApiSuccess) {
                throw new ApiException(400, ['error' => 'Payment failed']);
            }
        }

        $create['status'] = 'paid';

//        creating everything needed
        $model = Purchase::create([
            ...$create,
        ]);

//        creating relations
        if ($create['card_amount'] > 0) {
            $model->cashbacks()->create([
                'customer_id' => auth()->id(),
                'amount' => $create['cashback_amount'],
                'expires_at' => now()->addDays($setting->cashback_validity_days),
            ]);
        }
        foreach ($seats as $seat) {
            $model->purchaseSeats()->create([
                'seat_id' => $seat->getKey(),
            ]);
        }
        foreach ($combos as $key => $combo) {
            $model->purchaseCombos()->create([
                'combo_id' => $combo->getKey(),
                'quantity' => collect($data['combos'])->get($key)['quantity']
            ]);
        }
        $model->load('purchaseSeats.seat');
//        throwing success after all that
        throw new ApiException(201, PurchaseResource::make($model));
    }

//    getting the wallet info
    public function wallet()
    {
        $user = auth()->user();
        $models = $user->cashbacks;
        $sum = $models->filter(fn($m) => $m->expires_at->isBefore(now()))->sum('amount');
        return [
            'balance' => $sum,
            'cashback' => CashbackResource::collection($models),
        ];
    }
}
