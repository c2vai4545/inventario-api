<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RecreatesMigrationsTable extends Command
{
    protected $signature = 'migrate:recreate-table';
    protected $description = 'Recreates the migrations table and inserts existing migration records';

    public function handle()
    {
        Schema::dropIfExists('migrations');
        
        Schema::create('migrations', function ($table) {
            $table->increments('id');
            $table->string('migration');
            $table->integer('batch');
        });

        $migrations = glob(database_path().'/migrations/*.php');
        foreach ($migrations as $migration) {
            $migrationName = str_replace('.php', '', basename($migration));
            DB::table('migrations')->insert([
                'migration' => $migrationName,
                'batch' => 1
            ]);
        }

        $this->info('Migrations table recreated and populated.');
    }
}
