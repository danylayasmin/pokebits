<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use function Laravel\Prompts\select;

class PokeapiAllCommand extends Command
{
    protected $signature = 'pokeapi:all';

    protected $description = 'Run all commands to populate the database with data from PokeAPI. This command will take a long time to run.';

    public function __construct()
    {
        parent::__construct();
    }

    private function runAllCommands(): void
    {
        if ($this->confirm('This command will take a long time to run. Are you sure you want to continue?')) {
            $this->call('pokeapi:habitats');
            $this->call('pokeapi:types');
            $this->call('pokeapi:abilities');
            $this->call('pokeapi:pokemon');
            $this->call('pokeapi:moves');
            $this->call('pokeapi:species');
            $this->call('pokeapi:encounter-areas');
            $this->call('pokeapi:evolution-chains');
            $this->call('pokeapi:pokemon-abilities');
            $this->call('pokeapi:pokemon-types');
            $this->call('pokeapi:species-types');

            $this->info(PHP_EOL . 'All commands have been run.');
        }

    }

    private function populateFromDump(): void
    {
        if ($this->confirm('This will delete all data in the database and populate it with data from a SQL dump file. Are you sure you want to continue?')) {
            $this->call('migrate:fresh');
            $this->call('db:seed', ['--class' => 'SQLDumpSeeder']);
        }
    }
    public function handle(): void
    {
        $method = select(
            label: 'How would you like to populate the database?',
            options: [
                'dump' => 'From SQL dump file (recommended)',
                'api' => 'From PokeAPI (will take a long time to run)',
            ],
            default: 'dump'
        );

        $method === 'dump' ? $this->populateFromDump() : $this->runAllCommands();
    }
}
