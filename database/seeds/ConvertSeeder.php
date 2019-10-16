<?php

use Illuminate\Database\Seeder;
use App\Models\Convert\Treeleaf;
use App\Services\ConvertService;

class ConvertSeeder extends Seeder
{
    private $start;

    /**
     * ConvertSeeder constructor.
     * @param $start
     */
    public function __construct($start)
    {
        $this->start = $start;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Treeleaf::where('id', '>', $this->start)->limit(10000)->chunk(100, function ($queries){
            foreach ($queries as $treeLeaf){
                if ($item = Treeleaf::find($treeLeaf->id)) {
                    (new ConvertService($item))->handle();
                }
            }
        });
    }
}
