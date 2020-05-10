<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//\App\Models\Location::all()
//    ->load('villager')->each(function ($query) {
//        $query->update(['village'=>!empty($query['villager']['name_en']) ? $query['villager']['name_en'] : null ]);
//    });
//dd(\App\Models\Location::first());
use App\Exports\ExcelExport;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;


Route::get('/test-general', function () {
    $General = App\Models\General::all()->groupBy('type');

    foreach ($General as $index => $item){
        $General[$index] = collect($item)->sortBy('name')->take(10)->values()->all();
    }
    return response()->json($General);
});

Route::get('/natural_compound', function () {
    $name = Str::singular(Str::studly('MedicinalLocation'));
    $repo = 'App\\Repositories\\' . $name . 'Repository';
    $repo = resolve($repo);
    $result = $repo->all()->load(Arr::flatten($repo->model()::getAllRelations()));



//    if (\request()->filled('excel')) {
        $model = Str::ucfirst(\request('model'));
        $file_excel = "Export${model}List-" . date('Y-m-d-H-i-s') .'.xlsx';


        Excel::store(new ExcelExport($result, \request('model')), 'public/' . $file_excel, null, 'Xlsx');
        return $this->sendResponse(Storage::url($file_excel), 'success');
//    }
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


