<?php

namespace App\Console\Commands;

use App\Jobs\AutoChargeUsersPackage;
use Illuminate\Console\Command;

class AutoChargingChecker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'AutoChargingChecker:Cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        AutoChargeUsersPackage::dispatch();
    }
}
