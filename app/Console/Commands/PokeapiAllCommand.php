<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

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
        $this->call('pokeapi:habitats');
        $this->call('pokeapi:types');
        $this->call('pokeapi:abilities');
        $this->call('pokeapi:pokemon');
        $this->call('pokeapi:moves');
        $this->call('pokeapi:species');
        $this->call('pokeapi:encounter-areas');
        $this->call('pokeapi:evolution-chains');

        $this->info(PHP_EOL . 'All commands have been run.');
    }
    public function handle(): void
    {
        if ($this->confirm('This command will take a long time to run. Are you sure you want to continue?')) {
            $this->runAllCommands();
        }
    }
}
