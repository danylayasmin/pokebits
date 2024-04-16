<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

class PokemonController extends Controller
{
    public function index()
    {
        $data = Cache::remember('pokemon_data_frontend', 480, function () {
            $client = new Client(['base_uri' => 'https://pb.orianna.dev/api/',
                'timeout' => 120.0,
            ]);

            $response = $client->request('GET', 'pokemon');

            return json_decode($response->getBody()->getContents())->data;
        });

        return view('home', [
            'data' => $data

        ]);
    }
}
