<?php


namespace App\Http\Controllers\Convert;


use App\Models\Convert\Convert;

class IndexConvertController
{
    public function handle()
    {
        $converts = Convert::get();
        return view('convert.index', compact('converts'));
    }
}
