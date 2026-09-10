<?php

namespace App\Http\Controllers;

use App\Models\Customer;

class PublicController extends Controller
{
    public function index()
    {
        return view('public.index');
    }
}
