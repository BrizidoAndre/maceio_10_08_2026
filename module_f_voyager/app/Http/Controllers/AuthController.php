<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Customer;
use App\Models\Partner;
use App\Models\SalesPerson;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Psy\Util\Str;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function registerAction(Request $request)
    {
        $data = $request->validate([
            'name' => ['required',],
            'email' => ['required', 'email', 'unique:customers,email'],
            'password' => ['required',],
            'birthday' => ['required', 'date'],
            'profile_picture' => ['required', 'image'],
            'dependants' => ['array'],
            'dependants.*' => ['exists:customers,id']
        ]);
        $file = $request->file('profile_picture')->move('customers');
        $customers = Customer::whereIn('id', $data['dependants']);
        unset($data['dependants']);
        $model = Customer::create([
            ...$data,
            'profile_picture' => $file,
        ]);
        $customers->update(['customer_id' => $model->id]);
        return redirect()->route('login');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function loginAction(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required',]
        ]);
        $user = Admin::where('email', $data['email'])->first();
        $guard = 'web';
        if (!$user) {
            $user = Customer::where('email', $data['email'])->first();
            $guard = 'customers';
        }
        if (!$user) {
            $user = Partner::where('email', $data['email'])->first();
            $guard = 'partners';
        }
        if (!$user) {
            $user = SalesPerson::where('email', $data['email'])->first();
            $guard = 'salespersons';
        }
        if (!$user || !\Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => 'Invalid credentials',
            ]);
        }
        auth($guard)->login($user);
        return redirect()->route('home');
    }

    public function registerSaleperson()
    {
        return view('auth.registerSaleperson');
    }

    public function registerSalepersonAction(Request $request)
    {
        $data = $request->validate([
            'name' => ['required',],
            'email' => ['required', 'email', 'unique:sales_people,email'],
            'password' => ['required',],
            'profile_picture' => ['required', 'image'],
        ]);
        $profile = $request->file('profile_picture')->move('salesperson');
        $model = SalesPerson::create([
            ...$data,
            'profile_picture' => $profile,
        ]);
        return redirect()->route('home');
    }

    public function registerPartner()
    {
        return view('auth.registerPartner');
    }

    public function registerPartnerAction(Request $request)
    {
        $data = $request->validate([
            'legal_name' => 'required',
            'website' => 'required',
            'email' => 'required|email|unique:partners,email',
            'phone_number' => 'required',
        ]);
        $password = \Illuminate\Support\Str::before($data['email'], '@');
        $model = Partner::create([
            ...$data,
            'password' => $password,
        ]);
        return redirect()->route('home');
    }

    public function logout()
    {
        auth('customers')->logout();
        auth('partners')->logout();
        auth('web')->logout();
        auth('salespersons')->logout();
        session()->regenerate();
        return redirect()->route('login');
    }

}
