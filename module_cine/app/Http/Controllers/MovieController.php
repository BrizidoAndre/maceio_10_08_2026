<?php

namespace App\Http\Controllers;

use App\Http\Resources\MovieResource;
use App\Models\Movie;

class MovieController extends Controller
{
    // reading multiple
    public function index()
    {
        $movies = Movie::all();
        return MovieResource::collection($movies);
    }

    // reading single model
    public function show(Movie $movie)
    {
        return MovieResource::make($movie);
    }
}
