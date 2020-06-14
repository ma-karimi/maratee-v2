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


Route::get('/paleo-fix', function () {
    \App\Models\PaleobotanyTaxonomy::all()->each(function ($query) {

        $query->species_id = \App\Models\PaleobotanyGeneral::where(['name' => $query['species']['name'], 'type' => 'species'])->first()->id;

        \App\Models\PaleobotanyGeneral::where(['name' => $query['species']['name'], 'type' => 'species'])->where('id', '!=', $query->species_id)->delete();
        $query->species_authors = $query['speAuthors'] ?? null;

        $query->save();
        echo 'Taxonomy:' . $query->id . PHP_EOL;

    });

});

Route::get('/test-general', function () {
    \App\Models\MedicinalLocation::whereNotNull('taxonomy_id')
        ->with('taxonomy')
        ->whereHas('taxonomy', function ($query) {
            return $query->whereNotNull('name');
        })
        ->get()
        ->each(function ($query) {
            $query->local_name = $query->taxonomy['name'];
            $query->save();

            $query->taxonomy->name = null;
            $query->taxonomy->save();
        });

    \App\Models\Taxonomy::whereNotNull('name')->update(['name' => null]);

});


Route::get('/natural_compound', function () {
    $name = Str::singular(Str::studly('MedicinalLocation'));
    $repo = 'App\\Repositories\\' . $name . 'Repository';
    $repo = resolve($repo);
    $result = $repo->all()->load(Arr::flatten($repo->model()::getAllRelations()));


//    if (\request()->filled('excel')) {
    $model = Str::ucfirst(\request('model'));
    $file_excel = "Export${model}List-" . date('Y-m-d-H-i-s') . '.xlsx';


    Excel::store(new ExcelExport($result, \request('model')), 'public/' . $file_excel, null, 'Xlsx');
    return $this->sendResponse(Storage::url($file_excel), 'success');
//    }
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


