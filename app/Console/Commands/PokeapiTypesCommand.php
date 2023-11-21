<?php

namespace App\Console\Commands;

use App\Models\Type;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;

class PokeapiTypesCommand extends Command
{
    protected $signature = 'pokeapi:types';

    protected $description = 'Command description';

    /**
     * @throws GuzzleException
     */
    public function handle()
    {
        $client = new Client([
            'base_uri' => 'https://pokeapi.co/api/v2/',
            'timeout' => 3.0,
        ]);
        $response = $client->request('GET', 'type');

        if ($response->getStatusCode() !== 200) {
            $this->error('Failed to fetch data from PokeAPI.');
            return;
        }

        $data = json_decode($response->getBody()->getContents(), true);

        foreach ($data['results'] as $typeResults) {
//            "results": [
//    {
//        "name": "normal",
//      "url": "https://pokeapi.co/api/v2/type/1/"
//    },
//    {
//        "name": "fighting",
//      "url": "https://pokeapi.co/api/v2/type/2/"
//    },

            $this->info('Fetching data for ' . $typeResults['name'] . '...');
            $response = $client->request('GET', $typeResults['url']);
            $typeData = json_decode($response->getBody()->getContents(), true);
//            {
//                "damage_relations": {
//                "double_damage_from": [
//      {
//          "name": "fighting",
//        "url": "https://pokeapi.co/api/v2/type/2/"
//      }
//    ],
//    "double_damage_to": [],
//    "half_damage_from": [],
//    "half_damage_to": [
//      {
//          "name": "rock",
//        "url": "https://pokeapi.co/api/v2/type/6/"
//      },
//      {
//          "name": "steel",
//        "url": "https://pokeapi.co/api/v2/type/9/"
//      }
//    ],
//    "no_damage_from": [
//      {
//          "name": "ghost",
//        "url": "https://pokeapi.co/api/v2/type/8/"
//      }
//    ],
//    "no_damage_to": [
//      {
//          "name": "ghost",
//        "url": "https://pokeapi.co/api/v2/type/8/"
//      }
//    ]
//  },

            // Only add the names of the types to the damage relations
            Type::updateOrCreate([
                'name' => $typeData['name'],
                'double_damage_from' => collect($typeData['damage_relations']['double_damage_from'])->pluck('name')->toArray(),
                'double_damage_to' => collect($typeData['damage_relations']['double_damage_to'])->pluck('name')->toArray(),
                'half_damage_from' => collect($typeData['damage_relations']['half_damage_from'])->pluck('name')->toArray(),
                'half_damage_to' => collect($typeData['damage_relations']['half_damage_to'])->pluck('name')->toArray(),
                'no_damage_from' => collect($typeData['damage_relations']['no_damage_from'])->pluck('name')->toArray(),
                'no_damage_to' => collect($typeData['damage_relations']['no_damage_to'])->pluck('name')->toArray(),
            ]);
        }

        $this->info('Finished fetching Types from PokeAPI.');
    }
}
