<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class PokemonController extends Controller
{
    public function index()
    {
        $client = new Client([
            'base_uri' => 'http://127.0.0.1:8001/api/',
            'timeout' => 2.0,
        ]);

        $response = $client->request('GET', 'pokemon');

        $data = json_decode($response->getBody()->getContents());

        dd($data);
    }
}
