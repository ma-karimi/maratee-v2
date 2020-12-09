<?php

namespace App\Console\Commands;

use App\Models\ActionActor;
use App\Models\Herbarium;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class FixHerbarium extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix:herbarium';

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

        $max = ActionActor::where('actorable_type', Herbarium::class)->max('actorable_id');
        Herbarium::where('id', '<=', $max)->with('determiners', 'collectors')->chunk(200, function ($items) {
            foreach ($items as $item) {
                $item->determine_authors = $item->determiner ?? null;
                $item->collection_authors = $item->collector ?? null;
                $item->save();
//                $item->determiners()->get()->delete();
//                $item->collectors()->get()->delete();

                echo $item->id ."\r\n";
            }
        });

        DB::table('audits')->where('url', 'http://api.rifr-ac.ir/plant-form')->delete();
        DB::table('audits')->where('url', 'http://api.rifr-ac.ir/flora-fix')->delete();
    }
}
