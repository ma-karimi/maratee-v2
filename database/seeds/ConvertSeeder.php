<?php

use Illuminate\Database\Seeder;
use App\Models\Convert\Treeleaf;
use App\Services\ConvertService;

class ConvertSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param ConvertService $convertService
     * @return void
     */
    public function run(ConvertService $convertService)
    {
        $treeLeafs = Treeleaf::all();
        foreach ($treeLeafs as $treeLeaf)
            if ($treeLeaf->hasVillage())
                $convertService->treeLeaf($treeLeaf)->handle();
    }
}
