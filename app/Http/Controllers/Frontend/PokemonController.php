<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PokemonController extends Controller
{
    public function index()
    {
        return view('home');
    }
}
