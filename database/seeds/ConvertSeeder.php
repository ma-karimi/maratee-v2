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

        Treeleaf::where('id', '>', $this->start)->limit(10000)->get()->each(function ($treeLeaf) {
            (new ConvertService($treeLeaf))->handle();
        });
    }
}
