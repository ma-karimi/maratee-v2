<?php

use Illuminate\Database\Seeder;
use App\Models\Convert\Treeleaf;
use App\Services\ConvertService;

class ConvertSeeder extends Seeder
{
    private $skip;

    /**
     * ConvertSeeder constructor.
     * @param $skip
     */
    public function __construct($skip)
    {
        $this->skip = $skip;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Treeleaf::skip($this->skip)->chunk(100, function ($queries){
            foreach ($queries as $treeLeaf){
                if ($item = Treeleaf::find($treeLeaf->id)) {
                    (new ConvertService($item))->handle();
                }
            }
        });
    }
}
