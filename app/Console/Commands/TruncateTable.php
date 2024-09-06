<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TruncateTable extends Command
{
    // The name and signature of the console command.
    protected $signature = 'db:truncate {table}';

    // The console command description.
    protected $description = 'Truncate a specified database table';

    // Create a new command instance.
    public function __construct()
    {
        parent::__construct();
    }

    // Execute the console command.
    public function handle()
    {
        $table = $this->argument('table');
        
        if (!Schema::hasTable($table)) {
            $this->error("Table '{$table}' does not exist.");
            return 1; // Error code
        }
        
        DB::table($table)->truncate();
        $this->info("Table '{$table}' has been truncated.");
        return 0; // Success code
    }
}
