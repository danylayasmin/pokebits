<?php

namespace App\Console\Commands;

use App\Models\EncounterAreas;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use App\Traits\HandlesPokeAPIResponse;

class PokeapiEncounterAreasCommand extends Command
{
    use HandlesPokeAPIResponse;

    protected $signature = 'pokeapi:encounter-areas';

    protected $description = 'Fetch Encounter Areas data from PokeAPI and store it in the database.';

    public function handle(): void
    {
        $client = new Client([
            'base_uri' => 'https://pokeapi.co/api/v2/',
            'timeout' => 60.0,
        ]);
        $response = $client->request('GET', 'location-area?limit=1000');

        if (!$this->checkResponse($response)) {
            return;
        }

        $data = json_decode($response->getBody()->getContents(), true);

        $progressbar = $this->output->createProgressBar($data['count']);
        $progressbar->start();

        foreach ($data['results'] as $encounterAreasRes) {
            $encounterArea = $client->request('GET', $encounterAreasRes['url']);
            $encounterAreaData = json_decode($encounterArea->getBody()->getContents(), true);

            foreach ($encounterAreaData['pokemon_encounters'] as $encounter) {
                EncounterAreas::updateOrCreate(
                    [
                        'area_id' => $encounterAreaData['id'],
                        'pokemon_name' => $encounter['pokemon']['name'],
                        'chance' => $encounterAreaData['encounter_method_rates'][0]['version_details'][0]['rate'] ?? null
                    ],
                    [
                        'area_id' => $encounterAreaData['id'],
                        'area_name' => $encounterAreaData['name'],
                        'pokemon_name' => $encounter['pokemon']['name'],
                        'method' => $encounterAreaData['encounter_method_rates'][0]['encounter_method']['name'] ?? null,
                        'chance' => $encounterAreaData['encounter_method_rates'][0]['version_details'][0]['rate'] ?? null,
                    ]
                );
            }

            $progressbar->advance();
            sleep(0.025);
        }

        $progressbar->finish();
        $this->info(PHP_EOL . 'Finished fetching Encounter Areas from PokeAPI.');
    }
}
