<?php

namespace App\Http\Controllers;

class PayslipController extends Controller
{
    public function index()
    {
        return view('payslips.index');
    }

    public function generate()
    {
        return view('payslips.generate');
    }
}
