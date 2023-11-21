<?php

namespace App\Console\Commands;

use App\Models\Pokemon;
use App\Models\SpeciesTypes;
use App\Models\Type;
use App\Traits\HandlesPokeAPIResponse;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class PokeapiSpeciesTypesCommand extends Command
{
    use HandlesPokeAPIResponse;

    protected $signature = 'pokeapi:species-types';

    protected $description = 'Fetch PKMN Ability data from PokeAPI and store it in the database.';

    public function getTypesBySpeciesName($speciesName)
    {
        $pokemon = Pokemon::where('name', $speciesName)->first();
        $client = new Client([
            'base_uri' => 'https://pokeapi.co/api/v2/',
            'timeout' => 60.0,
        ]);

        $response = $client->request('GET', 'pokemon/' . $pokemon->pokemon_id);

        if (!$this->checkResponse($response)) {
            return;
        }

        $data = json_decode($response->getBody()->getContents(), true);

        if (isset($data['types']) && is_array($data['types'])) {
            return array_map(function ($type) {
                return $type['type']['name'];
            }, $data['types']);
        }

        return [];
    }

    public function handle(): void
    {
        $client = new Client([
            'base_uri' => 'https://pokeapi.co/api/v2/',
            'timeout' => 60.0,
        ]);
        $response = $client->request('GET', 'pokemon-species?limit=2000');

        if (!$this->checkResponse($response)) {
            return;
        }

        $data = json_decode($response->getBody()->getContents(), true);

        $progressbar = $this->output->createProgressBar($data['count']);
        $progressbar->start();

        foreach ($data['results'] as $allSpecies) {
            $species = $client->request('GET', $allSpecies['url']);
            $speciesData = json_decode($species->getBody()->getContents(), true);

            foreach ($speciesData['varieties'] as $variety) {
                $progressbar->setMessage('Fetching ' . $variety['pokemon']['name'] . ' species types');
                $types = $this->getTypesBySpeciesName($variety['pokemon']['name']);

                foreach ($types as $type) {
                    $typeId = Type::where('name', $type)->first()->id;
                    SpeciesTypes::updateOrCreate([
                        'species_id' => $speciesData['id'],
                        'type_id' => $typeId
                    ],
                        [
                            'species_id' => $speciesData['id'],
                            'type_id' => $typeId
                        ]);
                }
            }

            $progressbar->advance();
            sleep(0.10);
        }

        $progressbar->finish();
        $this->info(PHP_EOL . 'Finished fetching Species Types from PokeAPI.');
    }
}
