<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use PDO;

class DeleteDatabaseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'database:delete {dbname}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete a database';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        try {
            if (!($dbname = $this->argument('dbname'))) {
                $dbname = env('DB_DATABASE');
            }

            $connection = $this->hasArgument('connection') && $this->argument('connection') ? $this->argument('connection') : DB::connection('sqlsrv_master')->getPDO()->getAttribute(PDO::ATTR_DRIVER_NAME);

            $hasDb = DB::connection($connection)->select("SELECT name FROM master.sys.databases WHERE name = " . "'" . $dbname . "'");

            if (!empty($hasDb)) {
                DB::connection($connection)->select('DROP DATABASE ' . $dbname . ';');
                $this->info("Database '$dbname' deleted for '$connection' connection");
            } else {
                $this->warn("Database $dbname does not exist for $connection connection");
            }
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
