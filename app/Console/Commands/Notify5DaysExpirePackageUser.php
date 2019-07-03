<?php

namespace App\Console\Commands;

use App\Services\UserPackages\Frontend\UserPackageServices;
use Carbon\Carbon;
use Illuminate\Console\Command;

class Notify5DaysExpirePackageUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Notify5DaysExpirePackageUser:Cron';

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
        (new UserPackageServices())->set5DaysToExpirePackage();
    }
}
