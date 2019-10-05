<?php

use Illuminate\Database\Seeder;
use App\Models\Convert\Treeleaf;
use App\Services\ConvertService;

class ConvertSeeder extends Seeder
{
    private $skip;
    private $take;

    /**
     * ConvertSeeder constructor.
     */
    public function __construct($skip, $take)
    {
        $this->skip = $skip;
        $this->take = $take;
    }

    /**
     * Run the database seeds.
     *
     * @param ConvertService $convertService
     * @return void
     */
    public function run()
    {
        $treeLeafs = Treeleaf::skip($this->skip)->take($this->take)->get();
        foreach ($treeLeafs as $treeLeaf)
            if ($treeLeaf->hasVillage())
                (new ConvertService)->treeLeaf($treeLeaf)->handle();
    }
}
