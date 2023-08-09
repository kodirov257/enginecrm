<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use PDO;

class CreateDatabaseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:database {dbname?} {connection?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a database';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        try{
            if (!($dbname = $this->argument('dbname'))) {
                $dbname = env('DB_DATABASE');
            }

            $connection = $this->hasArgument('connection') && $this->argument('connection') ? $this->argument('connection'): DB::connection()->getPDO()->getAttribute(PDO::ATTR_DRIVER_NAME);

            $hasDb = DB::connection($connection)->select("SELECT name FROM master.sys.databases WHERE name = "."'".$dbname."'");

            if(empty($hasDb)) {
                DB::connection($connection)->select('CREATE DATABASE ' . $dbname . ';');
                $this->info("Database '$dbname' created for '$connection' connection");
            }
            else {
                $this->info("Database $dbname already exists for $connection connection");
            }
        }
        catch (\Exception $e){
            $this->error($e->getMessage());
        }
    }
}
