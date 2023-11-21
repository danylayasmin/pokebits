<?php

namespace App\Console\Commands;

use App\Models\Species;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;

class PokeapiSpeciesCommand extends Command
{
    protected $signature = 'pokeapi:species';

    protected $description = 'Fetch Species data from PokeAPI and store it in the database.';

    /**
     * @throws GuzzleException
     */
    public function handle(): void
    {
        $client = new Client([
            'base_uri' => 'https://pokeapi.co/api/v2/',
            'timeout' => 60.0,
        ]);
        $response = $client->request('GET', 'pokemon-species?limit=1500');

        if ($response->getStatusCode() !== 200) {
            $this->error('Failed to fetch data from PokeAPI.');
            return;
        }

        $data = json_decode($response->getBody()->getContents(), true);

        $progressbar = $this->output->createProgressBar($data['count']);
        $progressbar->start();

        foreach ($data['results'] as $speciesResults) {
            $speciesResult = $client->request('GET', $speciesResults['url']);
            $speciesData = json_decode($speciesResult->getBody()->getContents(), true);
            $pokemonUrl = $client->request('GET', $speciesData['varieties'][0]['pokemon']['url']);
            $pokemonData = json_decode($pokemonUrl->getBody()->getContents(), true);
            $averageColor = getAverageColorFromImageUrl(
                $pokemonData['sprites']['front_default'] ?? $pokemonData['sprites']['other']['official-artwork']['front_default']
            );
            $filteredEntries = array_filter($speciesData['flavor_text_entries'], function ($entry) {
                return $entry['language']['name'] === 'en';
            });
            $lastFlavorTextEntry = end($filteredEntries);
            $lastFlavorText = $lastFlavorTextEntry ? $lastFlavorTextEntry['flavor_text'] : null;


            foreach ($speciesData['varieties'] as $variety) {
                Species::updateOrCreate(
                    ['pokemon_name' => $variety['pokemon']['name']],
                    [
                        'pokemon_name' => $variety['pokemon']['name'],
                        'description' => $lastFlavorText,
                        'color_name' => $speciesData['color']['name'],
                        'color_hex' => $averageColor,
                        'shape' => $speciesData['shape']['name'] ?? null,
                        'base_happiness' => $speciesData['base_happiness'],
                        'capture_rate' => $speciesData['capture_rate'] ?? null,
                        'habitat' => $speciesData['habitat']['name'] ?? null,
                        'growth_rate' => $speciesData['growth_rate']['name'] ?? null,
                        'is_baby' => $speciesData['is_baby'],
                        'is_legendary' => $speciesData['is_legendary'],
                        'is_mythical' => $speciesData['is_mythical'],
                    ]
                );
            }

            $progressbar->advance();
            sleep(0.025);
        }

        $progressbar->finish();
        $this->info(PHP_EOL . 'Finished fetching Species from PokeAPI.');
    }
}
