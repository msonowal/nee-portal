<?php

namespace nee_portal\Console\Commands;

use Illuminate\Console\Command;
use DB, File;
class ImportStatesAndDistricts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will import states and districts data into respective tables.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info(" \nWelcome to Manash's SQL DUMPER. \n");
        $this->info(" \nImporting States as on states.sql \n");
        DB::unprepared(File::get(storage_path().'/states.sql'));

        $this->info(" \nImporting Districts on districts.sql \n");
        DB::unprepared(File::get(storage_path().'/districts.sql'));

        $this->info(" \nImporting Reservation alternative codes! \n");
        DB::unprepared(File::get(storage_path().'/reservation_alternates.sql'));
    }
}
