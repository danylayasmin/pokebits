<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

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

            DB::unprepared(file_get_contents($dump_path));

    }
}
