<?php

use App\Models\Convert\Treeleaf;
use App\Services\ConvertService;
use Illuminate\Database\Seeder;

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
        $treeLeafs = Treeleaf::get();
        foreach ($treeLeafs as $treeLeaf)
            $convertService->treeleaf($treeLeaf)->handle();
    }
}
