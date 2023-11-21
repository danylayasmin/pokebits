<?php

namespace App\Console\Commands;

use App\Models\EvolutionChain;
use App\Models\Pokemon;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class PokeapiEvolutionChainsCommand extends Command
{
    protected $signature = 'pokeapi:evolution-chains';

    protected $description = 'Fetch Evolution Chains data from PokeAPI and store it in the database.';

    public function handle(): void
    {
        $client = new Client([
            'base_uri' => 'https://pokeapi.co/api/v2/',
            'timeout' => 30.0,
        ]);
        $response = $client->request('GET', 'evolution-chain?limit=800');

        if ($response->getStatusCode() !== 200) {
            $this->error('Failed to fetch data from PokeAPI.');
            return;
        }

        $data = json_decode($response->getBody()->getContents(), true);

        $progressbar = $this->output->createProgressBar($data['count']);
        $progressbar->start();

        foreach ($data['results'] as $evolutionChainsResults) {
            $evolutionChain = $client->request('GET', $evolutionChainsResults['url']);
            $evolutionChainData = json_decode($evolutionChain->getBody()->getContents(), true);
            $pokemon = Pokemon::where('name', $evolutionChainData['chain']['species']['name'])->first();
            if (!$pokemon) {
                continue;
            }


            $evoChainArray = [];
            $evoChainArray[] = $evolutionChainData['chain']['species']['name'];
            if (isset($evolutionChainData['chain']['evolves_to'][0]['species']['name'])) {
                $evoChainArray[] = $evolutionChainData['chain']['evolves_to'][0]['species']['name'];
                if (isset($evolutionChainData['chain']['evolves_to'][0]['evolves_to'][0]['species']['name'])) {
                    $evoChainArray[] = $evolutionChainData['chain']['evolves_to'][0]['evolves_to'][0]['species']['name'];
                }
            }
            EvolutionChain::updateOrCreate(
                ['pokemon_id' => $pokemon->pokemon_id],
                [
                    'pokemon_id' => $pokemon->pokemon_id,
                    'evolution_chain' => $evoChainArray,
                ]
            );

            $progressbar->advance();
            sleep(0.025);
        }

        $progressbar->finish();
        $this->info(PHP_EOL . 'Finished fetching Evolution Chains from PokeAPI.');
    }
}
