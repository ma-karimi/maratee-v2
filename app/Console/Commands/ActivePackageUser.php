<?php

namespace App\Console\Commands;

use App\Jobs\ActivePackages;
use Illuminate\Console\Command;

class ActivePackageUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ActivePackageUser:Cron';

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
        ActivePackages::dispatch();
    }
}
