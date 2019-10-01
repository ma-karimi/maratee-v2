<?php


namespace App\Http\Controllers;


use App\Models\Convert\Treeleaf;
use App\Services\ConvertService;

class TestController
{
    public function handle(ConvertService $convertService)
    {
        ini_set('max_execution_time', 30000);
        ini_set('memory_limit', '2000M');
        $treeLeafs = Treeleaf::get();
        foreach ($treeLeafs as $treeLeaf)
            $convertService->treeleaf($treeLeaf)->handle();
    }
}
