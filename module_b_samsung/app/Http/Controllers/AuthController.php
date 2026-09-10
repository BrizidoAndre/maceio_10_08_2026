<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function loginAction(Request $request)
    {
        $data = $request->validate([
            'email' => ['required',],
            'password' => ['required',],
        ]);
        if ($data['email'] !== 'admin@hrportal.com' || $data['password'] !== 'HRAdmin2026!') {
            throw ValidationException::withMessages([
                'email' => 'Invalid email or password'
            ]);
        }
        $user = Employee::first();
        auth()->login($user);
        return redirect()->route('dashboard.index');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
