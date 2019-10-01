<?php


namespace App\Http\Controllers\Convert;


use App\Models\Convert\Convert;
use App\Models\Convert\Treeleaf;
use App\Services\ConvertService;
use Illuminate\Http\Request;

class ConvertController
{
    public function handle(Request $request,ConvertService $convertService)
    {
        $treeLeafs = Treeleaf::skip($this->getSkip())->take($request->count)->get();
        foreach ($treeLeafs as $treeLeaf)
            $convertService->treeleaf($treeLeaf)->handle();
        return redirect()->back();
    }

    private function getSkip(): int
    {
        return Convert::max('treeleaf_id') ?? 0;
    }

}
