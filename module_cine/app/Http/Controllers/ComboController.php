<?php

namespace App\Http\Controllers;

use App\Http\Resources\ComboResource;
use App\Models\Combo;

class ComboController extends Controller
{
    public function index()
    {
        $models = Combo::all();
        return ComboResource::collection($models);
    }
}
