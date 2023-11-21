<?php

namespace App\Console\Commands;

use App\Models\Pokemon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;

class PokeapiPokemonCommand extends Command
{
    protected $signature = 'pokeapi:pokemon';

    protected $description = 'Fetch Pokemon data from PokeAPI and store it in the database.';

    /**
     * @throws GuzzleException
     */
    public function handle(): void
    {
        $client = new Client([
            'base_uri' => 'https://pokeapi.co/api/v2/',
            'timeout' => 60.0,
        ]);
        $response = $client->request('GET', 'pokemon?limit=2000');

        if ($response->getStatusCode() !== 200) {
            $this->error('Failed to fetch data from PokeAPI.');
            return;
        }

        $data = json_decode($response->getBody()->getContents(), true);

        $progressbar = $this->output->createProgressBar($data['count']);
        $progressbar->start();

        foreach ($data['results'] as $pokemonResults) {
            $pokemonResult = $client->request('GET', $pokemonResults['url']);
            $pokemonData = json_decode($pokemonResult->getBody()->getContents(), true);

            Pokemon::updateOrCreate(
                ['name' => $pokemonData['name']],
                [
                    'name' => $pokemonData['name'],
                    'pokemon_id' => $pokemonData['id'],
                    'sprite_front' => $pokemonData['sprites']['front_default'],
                    'sprite_back' => $pokemonData['sprites']['back_default'],
                    'artwork' => $pokemonData['sprites']['other']['official-artwork']['front_default'],
                    'stat_hp' => $pokemonData['stats'][0]['base_stat'],
                    'stat_attack' => $pokemonData['stats'][1]['base_stat'],
                    'stat_defense' => $pokemonData['stats'][2]['base_stat'],
                    'stat_special_attack' => $pokemonData['stats'][3]['base_stat'],
                    'stat_special_defense' => $pokemonData['stats'][4]['base_stat'],
                    'stat_speed' => $pokemonData['stats'][5]['base_stat'],
                    'height' => $pokemonData['height'],
                    'weight' => $pokemonData['weight']
                ]
            );
            $progressbar->advance();
            sleep(0.10);
        }

        $progressbar->finish();
        $this->info(PHP_EOL . 'Finished fetching all Pokemon from PokeAPI.');
    }
}
