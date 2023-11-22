<?php

namespace App\Console\Commands;

use App\Models\PokemonAbility;
use App\Traits\HandlesPokeAPIResponse;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;

class PokeapiPokemonAbilitiesCommand extends Command
{
    use HandlesPokeAPIResponse;

    protected $signature = 'pokeapi:pokemon-abilities';

    protected $description = 'Fetch PKMN Ability data from PokeAPI and store it in the database.';

    /**
     * @throws GuzzleException
     */
    public function handle(): void
    {
        $client = new Client([
            'base_uri' => 'https://pokeapi.co/api/v2/',
            'timeout' => 60.0,
        ]);
        $response = $client->request('GET', 'ability?limit=500');

        if (!$this->checkResponse($response)) {
            return;
        }

        $data = json_decode($response->getBody()->getContents(), true);

        $progressbar = $this->output->createProgressBar($data['count']);
        $progressbar->start();

        foreach ($data['results'] as $abilities) {
            $ability = $client->request('GET', $abilities['url']);
            $abilityData = json_decode($ability->getBody()->getContents(), true);

            foreach ($abilityData['pokemon'] as $pokemon) {
                PokemonAbility::updateOrCreate([
                    'pokemon' => $pokemon['pokemon']['name'],
                    'ability' => $abilities['name'],
                ],
                    [
                        'pokemon' => $pokemon['pokemon']['name'],
                        'ability' => $abilities['name'],
                    ]);
            }

            $progressbar->advance();
            sleep(0.10);
        }

        $progressbar->finish();
        $this->info(PHP_EOL . 'Finished fetching Pokemon Abilities from PokeAPI.');
    }
}
