<?php


namespace App\Http\Controllers\Convert;


use App\Models\Convert\Convert;
use Illuminate\Http\Request;

class RollbackConvertController
{
    public function handle(Request $request)
    {
        $converts = Convert::where('id', '>=', $request->id)->get();
        $converts->each(function ($convert){
            $convert->taxonomy()->delete();
            $convert->location()->delete();
            $convert->collectHub()->delete();
            $convert->detectHub()->delete();
            $convert->plantHerbarium()->delete();
            $convert->delete();
        });
        return redirect()->route('convert.index');
    }
}
