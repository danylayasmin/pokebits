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
            'base_uri' => 'https://pokebits.by-a.dev/api/',
            'timeout' => 2.0,
        ]);

        $response = $client->request('GET', 'pokemon');

        $data = json_decode($response->getBody()->getContents());

        dd($data);
    }
}
