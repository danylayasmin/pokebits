<?php

namespace App\Console\Commands;

use App\Models\Item;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use App\Traits\HandlesPokeAPIResponse;

class PokeapiItemsCommand extends Command
{
    use HandlesPokeAPIResponse;

    protected $signature = 'pokeapi:items';

    protected $description = 'Fetch item data from PokeAPI and store it in the database.';

    public function handle(): void
    {
        $client = new Client([
            'base_uri' => 'https://pokeapi.co/api/v2/',
            'timeout' => 60.0,
        ]);
        $response = $client->request('GET', 'item?limit=5000');

        if (!$this->checkResponse($response)) {
            return;
        }

        $data = json_decode($response->getBody()->getContents(), true);

        $progressbar = $this->output->createProgressBar($data['count']);
        $progressbar->start();

        foreach ($data['results'] as $items) {
            $item = $client->request('GET', $items['url']);
            $itemData = json_decode($item->getBody()->getContents(), true);
            $filteredEntries = array_filter($itemData['flavor_text_entries'], function ($entry) {
                return $entry['language']['name'] === 'en';
            });
            $lastFlavorTextEntry = end($filteredEntries);
            $lastFlavorText = $lastFlavorTextEntry ? $lastFlavorTextEntry['text'] : null;

                Item::updateOrCreate([
                    'name' => $itemData['name'],
                ],
                    [
                        'name' => $itemData['name'],
                        'effect' => $itemData['effect_entries'][0]['effect'] ?? null,
                        'description' => $lastFlavorText,
                        'sprite' => $itemData['sprites']['default'],
                    ]);

            $progressbar->advance();
            sleep(0.10);
        }

        $progressbar->finish();
        $this->info(PHP_EOL . 'Finished fetching Items from PokeAPI.');
    }
}
