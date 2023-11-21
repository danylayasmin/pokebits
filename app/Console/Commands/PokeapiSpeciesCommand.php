<?php

namespace App\Console\Commands;

use App\Models\Species;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;

class PokeapiSpeciesCommand extends Command
{
    protected $signature = 'pokeapi:species';

    protected $description = 'Command description';

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

            Species::updateOrCreate([
                'pokemon_name' => $speciesData['name'],
                'description' => $speciesData['flavor_text_entries'][0]['flavor_text'],
                'color_name' => $speciesData['color']['name'],
                'color_hex' => $speciesData['color']['todo'], // todo
                'shape' => $speciesData['shape']['name'],
                'base_happiness' => $speciesData['base_happiness'],
                'capture_rate' => $speciesData['capture_rate'],
                'habitat' => $speciesData['habitat']['name'],
                'growth_rate' => $speciesData['growth_rate']['name'],
                'is_baby' => $speciesData['is_baby'],
                'is_legendary' => $speciesData['is_legendary'],
                'is_mythical' => $speciesData['is_mythical'],
            ]);
            $progressbar->advance();
            sleep(0.10);
        }

        $progressbar->finish();
        $this->info('Finished fetching Species from PokeAPI.');
    }
}
