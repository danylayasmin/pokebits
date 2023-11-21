<?php

namespace App\Console\Commands;

use App\Models\Ability;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;

class PokeapiAbilitiesCommand extends Command
{
    protected $signature = 'pokeapi:abilities';

    protected $description = 'Fetch Abilities data from PokeAPI and store it in the database.';

    /**
     * @throws GuzzleException
     */
    public function handle(): void
    {
        $client = new Client([
            'base_uri' => 'https://pokeapi.co/api/v2/',
            'timeout' => 30.0,
        ]);
        $response = $client->request('GET', 'ability?limit=500');

        if ($response->getStatusCode() !== 200) {
            $this->error('Failed to fetch data from PokeAPI.');
            return;
        }

        $data = json_decode($response->getBody()->getContents(), true);

        $progressbar = $this->output->createProgressBar($data['count']);
        $progressbar->start();

        foreach ($data['results'] as $abilityResults) {
            $response = $client->request('GET', $abilityResults['url']);
            $typeData = json_decode($response->getBody()->getContents(), true);

            $filteredEffects = array_filter($typeData['effect_entries'], function ($effect) {
                return $effect['language']['name'] === 'en';
            });
            $desiredEffect = isset($filteredEffects[1]) ? $filteredEffects[1]['effect'] :
                ($filteredEffects[0]['effect'] ?? null);

            Ability::updateOrCreate(
                ['name' => $typeData['name']],
                [
                    'name' => $typeData['name'],
                    'effect' => $desiredEffect,
                ]
            );

            $progressbar->advance();
            sleep(0.025);
        }

        $progressbar->finish();
        $this->info(PHP_EOL . 'Finished fetching Abilities from PokeAPI.');
    }
}
