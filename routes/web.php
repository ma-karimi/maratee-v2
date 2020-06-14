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
Route::get('/flora-fix', function () {
    ini_set('max_execution_time', 3000);
    ini_set('memory_limit', '2000M');
    \App\Models\Taxonomy::all()->each(function ($query) {


        if (!empty($query->species_id)) {
            $query->species_id = \App\Models\General::where(['name' => $query['species']['name'], 'type' => 'species'])->first()->id;
            $query->species_authors = $query['speAuthors'] ?? null;
            $species = \App\Models\General::where(['name' => $query['species']['name'], 'type' => 'species'])->where('id', '!=', $query->species_id)->get();
            \App\Models\Taxonomy::whereIn('species_id', $species->pluck('id')->toArray())->update(['species_id' => $query->species_id]);
            foreach ($species as $index => $item) {
//                    $query->authors()->delete();
                $item->forceDelete();
            }
        }
        if (!empty($query->subspecies_id)) {
            $query->subspecies_id = \App\Models\General::where(['name' => $query['subspecies']['name'], 'type' => 'sub_species'])->first()->id;

            $query->species_authors = $query['subSpeAuthors'] ?? null;
            $subspecies = \App\Models\General::where(['name' => $query['subspecies']['name'], 'type' => 'sub_species'])->where('id', '!=', $query->subspecies_id)
                ->get();
            \App\Models\Taxonomy::whereIn('subspecies_id', $species->pluck('id')->toArray())->update(['subspecies_id' => $query->subspecies_id]);
            foreach ($subspecies as $index => $item) {
//                    $query->authors()->delete();
                $item->forceDelete();
            }
        }
        if (!empty($query->variety_id)) {
            $query->variety_id = \App\Models\General::where(['name' => $query['variety']['name'], 'type' => 'variety'])->first()->id;

            $query->variety_authors = $query['varAuthors'] ?? null;
            $varieties = \App\Models\General::where(['name' => $query['variety']['name'], 'type' => 'variety'])->where('id', '!=', $query->variety_id)
                ->get();

            \App\Models\Taxonomy::whereIn('variety_id', $species->pluck('id')->toArray())->update(['variety_id' => $query->variety_id]);
            foreach ($varieties as $index => $item) {
//                    $query->authors()->delete();
                $item->forceDelete();
            }
        }
        $query->save();
        echo 'Taxonomy:' . $query->id . '<br>';

    });
    \App\Models\ActorHub::where('actorable_type', \App\Models\General::class)->forceDelete();
    \App\Models\ActorHub::where('actorable_type', \App\Models\NonflowerGeneral::class)->forceDelete();
    \App\Models\ActorHub::where('actorable_type', \App\Models\PaleobotanyGeneral::class)->forceDelete();

});
Route::get('/herbarium-fix', function () {
    ini_set('max_execution_time', 3000);
    ini_set('memory_limit', '2000M');
    \App\Models\Herbarium::all()->each(function ($query) {


        $query->collection_date = $query->collect->date ?? null;
        $query->determine_date = $query->determine->date ?? null;
        resolve(\App\Repositories\HerbariumRepository::class)->createHub($query->id, 'collectors', collect($query->collect->actors->pluck('id')->toArray())->filter()->all());
        resolve(\App\Repositories\HerbariumRepository::class)->createHub($query->id, 'determiners', collect($query->determine->actors->pluck('id')->toArray())->filter()->all());

        $query->save();
        echo 'Taxonomy:' . $query->id . '<br>';

    });
    \App\Models\ActionHub::where('actorable_type', \App\Models\Herbarium::class)->forceDelete();

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


