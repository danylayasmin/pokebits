<?php

namespace App\Console\Commands;

use App\Models\PokemonType;
use App\Traits\HandlesPokeAPIResponse;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;

class PokeapiPokemonTypesCommand extends Command
{
    use HandlesPokeAPIResponse;

    protected $signature = 'pokeapi:pokemon-types';

    protected $description = 'Fetch PKMN Type data from PokeAPI and store it in the database.';

    /**
     * @throws GuzzleException
     */
    public function handle(): void
    {
        $client = new Client([
            'base_uri' => 'https://pokeapi.co/api/v2/',
            'timeout' => 60.0,
        ]);
        $response = $client->request('GET', 'type?limit=50');

        if (!$this->checkResponse($response)) {
            return;
        }

        $data = json_decode($response->getBody()->getContents(), true);

        $progressbar = $this->output->createProgressBar($data['count']);
        $progressbar->start();

        foreach ($data['results'] as $types) {
            $type = $client->request('GET', $types['url']);
            $typeData = json_decode($type->getBody()->getContents(), true);

            foreach ($typeData['pokemon'] as $pokemon) {
                PokemonType::updateOrCreate([
                    'pokemon' => $pokemon['pokemon']['name'],
                    'type' => $types['name'],
                ],
                    [
                        'pokemon' => $pokemon['pokemon']['name'],
                        'type' => $types['name'],
                    ]);
            }

            $progressbar->advance();
            sleep(0.10);
        }

        $progressbar->finish();
        $this->info(PHP_EOL . 'Finished fetching Pokemon Types from PokeAPI.');
    }
}
