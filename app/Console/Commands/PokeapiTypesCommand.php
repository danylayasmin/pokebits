<?php

namespace App\Console\Commands;

use App\Models\Type;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;

class PokeapiTypesCommand extends Command
{
    protected $signature = 'pokeapi:types';

    protected $description = 'Fetch Types data from PokeAPI and store it in the database.';

    /**
     * @throws GuzzleException
     */
    public function handle(): void
    {
        $client = new Client([
            'base_uri' => 'https://pokeapi.co/api/v2/',
            'timeout' => 5.0,
        ]);
        $response = $client->request('GET', 'type');

        if ($response->getStatusCode() !== 200) {
            $this->error('Failed to fetch data from PokeAPI.');
            return;
        }

        $data = json_decode($response->getBody()->getContents(), true);

        $progressbar = $this->output->createProgressBar($data['count']);
        $progressbar->start();

        foreach ($data['results'] as $typeResults) {
            $response = $client->request('GET', $typeResults['url']);
            $typeData = json_decode($response->getBody()->getContents(), true);
            Type::updateOrCreate(
                ['name' => $typeData['name'],],
                [
                    'name' => $typeData['name'],
                    'double_damage_from' => collect($typeData['damage_relations']['double_damage_from'])->pluck(
                        'name'
                    )->toArray(),
                    'double_damage_to' => collect($typeData['damage_relations']['double_damage_to'])->pluck(
                        'name'
                    )->toArray(),
                    'half_damage_from' => collect($typeData['damage_relations']['half_damage_from'])->pluck(
                        'name'
                    )->toArray(),
                    'half_damage_to' => collect($typeData['damage_relations']['half_damage_to'])->pluck(
                        'name'
                    )->toArray(),
                    'no_damage_from' => collect($typeData['damage_relations']['no_damage_from'])->pluck(
                        'name'
                    )->toArray(),
                    'no_damage_to' => collect($typeData['damage_relations']['no_damage_to'])->pluck('name')->toArray(),
                ]
            );

            $progressbar->advance();
            sleep(0.10);
        }

        $progressbar->finish();

        $this->info(PHP_EOL . 'Finished fetching Types from PokeAPI.');
    }
}
