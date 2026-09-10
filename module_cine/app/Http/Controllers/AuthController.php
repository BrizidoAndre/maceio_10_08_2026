<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    // logs the user
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);
        $user = Customer::where('email', $data['email'])->first();
        if (!$user || !\Hash::check($data['password'], $user->password)) {
            throw new ApiException(401, ['error' => 'Unauthorized']);
        }
        $token = Str::random(52);
        $user->update([
            'token' => $token,
        ]);
        return [
            'token' => $token,
        ];
    }

    // creates a new customer
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required'],
            'password' => ['required'],
            'email' => ['required', 'unique:customers,email', 'email'],
        ]);
        $model = Customer::create($data);
        throw new ApiException(201, [
            'id' => $model->id,
            'name' => $model->name,
            'email' => $model->email,
        ]);
    }

//    remove the token attribute from the authenticated user
    public function logout()
    {
        $user = auth()->user();
        $user->update([
            'token' => null,
        ]);
        return [
            'message' => 'Successfully logged out'
        ];
    }
}
