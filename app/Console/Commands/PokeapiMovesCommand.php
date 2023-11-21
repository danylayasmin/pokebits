<?php

namespace App\Console\Commands;

use App\Models\Move;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;

class PokeapiMovesCommand extends Command
{
    protected $signature = 'pokeapi:moves';

    protected $description = 'Fetch Moves data from PokeAPI and store it in the database.';

    /**
     * @throws GuzzleException
     */
    public function handle(): void
    {
        $client = new Client([
            'base_uri' => 'https://pokeapi.co/api/v2/',
            'timeout' => 60.0,
        ]);
        $response = $client->request('GET', 'move?limit=1000');

        if ($response->getStatusCode() !== 200) {
            $this->error('Failed to fetch data from PokeAPI.');
            return;
        }

        $data = json_decode($response->getBody()->getContents(), true);

        $progressbar = $this->output->createProgressBar($data['count']);
        $progressbar->start();

        foreach ($data['results'] as $moveResults) {
            $moveResult = $client->request('GET', $moveResults['url']);
            $moveData = json_decode($moveResult->getBody()->getContents(), true);

            Move::updateOrCreate(
                ['name' => $moveData['name']],
                [
                    'name' => $moveData['name'],
                    'accuracy' => $moveData['accuracy'],
                    'effect_chance' => $moveData['effect_chance'],
                    'pp' => $moveData['pp'],
                    'priority' => $moveData['priority'],
                    'power' => $moveData['power'],
                    'type' => $moveData['type']['name'],
                ]
            );

            $progressbar->advance();
            sleep(0.10);
        }

        $progressbar->finish();
        $this->info(PHP_EOL . 'Finished fetching Moves from PokeAPI.');
    }
}
