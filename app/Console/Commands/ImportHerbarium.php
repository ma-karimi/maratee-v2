<?php

namespace App\Console\Commands;

use App\Models\Convert\Treeleaf;
use App\Services\ConvertService;
use Illuminate\Console\Command;

class ImportHerbarium extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:herbarium {start?}';

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
        $start = $this->argument('start');
        Treeleaf::when(!empty($start), function ($query) use ($start) {
            return $query->where('id', '>', $start);
        })->chunk(200, function ($items) {
            foreach ($items as $item) {
                (new ConvertService($item))->handle();
        }
        });
    }
}
