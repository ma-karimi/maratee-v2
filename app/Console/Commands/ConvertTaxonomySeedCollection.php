<?php

namespace App\Console\Commands;

use App\Imports\SeedCollectionImport;
use App\Imports\SeedWeightImport;
use App\Models\SeedCollection;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Class ConvertTaxonomySeedCollection
 * @package App\Console\Commands
 *
 * @author Faeze Eghlima
 */
class ConvertTaxonomySeedCollection extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'convert:taxonomy_seed_collection';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command find repetitive province and remove them';

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
     * This function get repetitive province and delete them and replace that province has minimum id in location and city
     * @return mixed
     */
    public function handle()
    {
        ini_set('max_execution_time', 9000);
        ini_set('memory_limit', '4000M');
        Excel::import(new SeedCollectionImport(), public_path('/excels/collection1400.xlsx'));
    }
}
