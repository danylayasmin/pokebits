<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class SQLDumpSeeder extends Seeder
{
    public function run(): void
    {
        $dump_path = storage_path('app/pokeapi_data.sql');

        if (!file_exists($dump_path)) {
            $this->command->error('No dump file found at ' . $dump_path);
            return;
        }

        $this->command->info('Populating database from dump file...');

        $process = new Process([
            'mysql',
            '-h',
            DB::getConfig('host'),
            '-u',
            DB::getConfig('username'),
            '--password=' . DB::getConfig('password'),
            DB::getConfig('database'),
            '-e',
            'source ' . $dump_path,
        ]);
        $process->setTimeout(500);
        try {
            $process->mustRun();
            echo "Command executed successfully.";
        } catch (ProcessFailedException $exception) {
            echo "The command failed: " . $exception->getMessage() . "\n";
            echo "Error Output: " . $process->getErrorOutput() . "\n";
            echo "Output: " . $process->getOutput() . "\n";
        }
    }
}
