<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function login()
    {
        return view('auth.login');
    }

    public function loginAction(Request $request)
    {
        $data = $request->validate([
            'username' => ['required',],
            'password' => ['required',],
        ]);
        $user = User::where('username', $data['username'])->first();
        if (!$user || !\Hash::check($data['password'], $user->password)) {
            return back()->with('warning', 'Invalid credentials');
        }
        auth()->login($user);
        return redirect()->route('post.index');
    }

    public function signup()
    {
        return view('auth.signup');
    }

    public function signupAction(Request $request)
    {
        $data = $request->validate([
            'username' => ['required', 'min:6'],
            'password' => ['required', 'min:6'],
        ]);
        User::create($data);
        return redirect()->route('login');
    }
}
