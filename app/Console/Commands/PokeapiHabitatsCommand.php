<?php

namespace App\Console\Commands;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;
use GuzzleHttp\Client;
use App\Models\Habitat;

class PokeapiHabitatsCommand extends Command
{
    protected $signature = 'pokeapi:habitats';

    protected $description = 'Fetch Habitat data from PokeAPI and store it in the database.';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @throws GuzzleException
     */
    public function handle(): void
    {
        $client = new Client([
            'base_uri' => 'https://pokeapi.co/api/v2/',
            'timeout' => 5.0,
        ]);
        $response = $client->request('GET', 'pokemon-habitat');

        if ($response->getStatusCode() !== 200) {
            $this->error('Failed to fetch data from PokeAPI.');
            return;
        }

        $data = json_decode($response->getBody()->getContents(), true);

        $progressbar = $this->output->createProgressBar($data['count']);
        $progressbar->start();

        foreach ($data['results'] as $habitat) {
            $response = $client->request('GET', $habitat['url']);
            $habitatData = json_decode($response->getBody()->getContents(), true);
            Habitat::updateOrCreate([
                'name' => $habitatData['name'],
            ]);

            $progressbar->advance();
            sleep(0.10);
        }

        $progressbar->finish();

        $this->info('Finished fetching Habitats from PokeAPI.');
    }
}
