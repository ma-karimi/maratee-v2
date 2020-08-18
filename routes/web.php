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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

//dd(\App\Models\Plant::whereNotNull('life_form_id')->first()->life_form);

Route::get('plant-form', function () {
    $plants = \App\Models\Plant::all()->each(function ($data) {
        if($data->life_form_id){
        $life_forms = $phytogeographics = [];
        $life_forms[] = $data->life;
        $data->life_forms = $life_forms;
        }
//        $phytogeographics[]= $data->phytogeographic;
        $data->phytogeographics = $data->phytogeographic()->count() ? collect($data->phytogeographic)->map(function ($item, $key) {
            return ['id' => (string) $item['id'], 'name' => $item['name']];
        })->all() : null;
        $data->save();
    });
});
Route::get('nonflower-general-fix', function () {
    DB::table('nonflower_generals')
        ->select('name', DB::raw('count(name)'), DB::raw('GROUP_CONCAT(`id` SEPARATOR ", ") as ids'), DB::raw('GROUP_CONCAT(`type` SEPARATOR ", ")'), DB::raw('Min(`id`) as primary_id'))
        ->where('type', 'species')
        ->groupBy('name')
        ->havingRaw('count(name) > 1')
        ->get()
//        ->dd()
        ->each(function ($data) {
            $explode = explode(', ', $data->ids);
            $items = collect($explode)->filter(function ($value, $key) use ($data) {
                return $value != $data->primary_id;
            })->all();

            \App\Models\NonflowerTaxonomy::whereIn('species_id', $explode)->select('id', 'species_id', 'updated_at')->update(['species_id' => $data->primary_id]);

            DB::table('nonflower_generals')->whereIn('id', $items)->delete();

        }
        );

    DB::table('nonflower_generals')
        ->select('name', DB::raw('count(name)'), DB::raw('GROUP_CONCAT(`id` SEPARATOR ", ") as ids'), DB::raw('GROUP_CONCAT(`type` SEPARATOR ", ")'), DB::raw('Min(`id`) as primary_id'))
        ->where('type', 'family')
        ->groupBy('name')
        ->havingRaw('count(name) > 1')
        ->get()
//        ->dd()
        ->each(function ($data) {
            $explode = explode(', ', $data->ids);
            $items = collect($explode)->filter(function ($value, $key) use ($data) {
                return $value != $data->primary_id;
            })->all();

            \App\Models\NonflowerTaxonomy::whereIn('family_id', $explode)->select('id', 'family_id', 'updated_at')->update(['family_id' => $data->primary_id]);

            DB::table('nonflower_generals')->whereIn('id', $items)->delete();

        }
        );

    DB::table('nonflower_generals')
        ->select('name', DB::raw('count(name)'), DB::raw('GROUP_CONCAT(`id` SEPARATOR ", ") as ids'), DB::raw('GROUP_CONCAT(`type` SEPARATOR ", ")'), DB::raw('Min(`id`) as primary_id'))
        ->where('type', 'genus')
        ->groupBy('name')
        ->havingRaw('count(name) > 1')
        ->get()
//        ->dd()
        ->each(function ($data) {
            $explode = explode(', ', $data->ids);
            $items = collect($explode)->filter(function ($value, $key) use ($data) {
                return $value != $data->primary_id;
            })->all();

            \App\Models\NonflowerTaxonomy::whereIn('genus_id', $explode)->select('id', 'genus_id', 'updated_at')->update(['genus_id' => $data->primary_id]);

            DB::table('nonflower_generals')->whereIn('id', $items)->delete();

        }
        );
    DB::table('nonflower_generals')
        ->select('name', DB::raw('count(name)'), DB::raw('GROUP_CONCAT(`id` SEPARATOR ", ") as ids'), DB::raw('GROUP_CONCAT(`type` SEPARATOR ", ")'), DB::raw('Min(`id`) as primary_id'))
        ->where('type', 'sub_species')
        ->groupBy('name')
        ->havingRaw('count(name) > 1')
        ->get()
//        ->dd()
        ->each(function ($data) {
            $explode = explode(', ', $data->ids);
            $items = collect($explode)->filter(function ($value, $key) use ($data) {
                return $value != $data->primary_id;
            })->all();

            \App\Models\NonflowerTaxonomy::whereIn('subspecies_id', $explode)->select('id', 'subspecies_id', 'updated_at')->update(['subspecies_id' => $data->primary_id]);

            DB::table('nonflower_generals')->whereIn('id', $items)->delete();

        }
        );

    DB::table('nonflower_generals')
        ->select('name', DB::raw('count(name)'), DB::raw('GROUP_CONCAT(`id` SEPARATOR ", ") as ids'), DB::raw('GROUP_CONCAT(`type` SEPARATOR ", ")'), DB::raw('Min(`id`) as primary_id'))
        ->where('type', 'variety')
        ->groupBy('name')
        ->havingRaw('count(name) > 1')
        ->get()
//        ->dd()
        ->each(function ($data) {
            $explode = explode(', ', $data->ids);
            $items = collect($explode)->filter(function ($value, $key) use ($data) {
                return $value != $data->primary_id;
            })->all();

            \App\Models\NonflowerTaxonomy::whereIn('variety_id', $explode)->select('id', 'variety_id', 'updated_at')->update(['variety_id' => $data->primary_id]);

            DB::table('nonflower_generals')->whereIn('id', $items)->delete();

        }
        );


});
Route::get('taxonomy-fix', function () {
    DB::table('generals')
        ->select('name', DB::raw('count(name)'), DB::raw('GROUP_CONCAT(`id` SEPARATOR ", ") as ids'), DB::raw('GROUP_CONCAT(`type` SEPARATOR ", ")'), DB::raw('Min(`id`) as primary_id'))
        ->where('type', 'species')
        ->groupBy('name')
        ->havingRaw('count(name) > 1')
        ->get()
//        ->dd()
        ->each(function ($data) {
            $explode = explode(', ', $data->ids);
            $items = collect($explode)->filter(function ($value, $key) use ($data) {
                return $value != $data->primary_id;
            })->all();

            \App\Models\Taxonomy::whereIn('species_id', $explode)->select('id', 'species_id', 'updated_at')->update(['species_id' => $data->primary_id]);

            DB::table('generals')->whereIn('id', $items)->delete();

        }
        );

    DB::table('generals')
        ->select('name', DB::raw('count(name)'), DB::raw('GROUP_CONCAT(`id` SEPARATOR ", ") as ids'), DB::raw('GROUP_CONCAT(`type` SEPARATOR ", ")'), DB::raw('Min(`id`) as primary_id'))
        ->where('type', 'family')
        ->groupBy('name')
        ->havingRaw('count(name) > 1')
        ->get()
//        ->dd()
        ->each(function ($data) {
            $explode = explode(', ', $data->ids);
            $items = collect($explode)->filter(function ($value, $key) use ($data) {
                return $value != $data->primary_id;
            })->all();

            \App\Models\Taxonomy::whereIn('family_id', $explode)->select('id', 'family_id', 'updated_at')->update(['family_id' => $data->primary_id]);

            DB::table('generals')->whereIn('id', $items)->delete();

        }
        );

    DB::table('generals')
        ->select('name', DB::raw('count(name)'), DB::raw('GROUP_CONCAT(`id` SEPARATOR ", ") as ids'), DB::raw('GROUP_CONCAT(`type` SEPARATOR ", ")'), DB::raw('Min(`id`) as primary_id'))
        ->where('type', 'genus')
        ->groupBy('name')
        ->havingRaw('count(name) > 1')
        ->get()
//        ->dd()
        ->each(function ($data) {
            $explode = explode(', ', $data->ids);
            $items = collect($explode)->filter(function ($value, $key) use ($data) {
                return $value != $data->primary_id;
            })->all();

            \App\Models\Taxonomy::whereIn('genus_id', $explode)->select('id', 'genus_id', 'updated_at')->update(['genus_id' => $data->primary_id]);

            DB::table('generals')->whereIn('id', $items)->delete();

        }
        );
    DB::table('generals')
        ->select('name', DB::raw('count(name)'), DB::raw('GROUP_CONCAT(`id` SEPARATOR ", ") as ids'), DB::raw('GROUP_CONCAT(`type` SEPARATOR ", ")'), DB::raw('Min(`id`) as primary_id'))
        ->where('type', 'sub_species')
        ->groupBy('name')
        ->havingRaw('count(name) > 1')
        ->get()
//        ->dd()
        ->each(function ($data) {
            $explode = explode(', ', $data->ids);
            $items = collect($explode)->filter(function ($value, $key) use ($data) {
                return $value != $data->primary_id;
            })->all();

            \App\Models\Taxonomy::whereIn('subspecies_id', $explode)->select('id', 'subspecies_id', 'updated_at')->update(['subspecies_id' => $data->primary_id]);

            DB::table('generals')->whereIn('id', $items)->delete();

        }
        );

    DB::table('generals')
        ->select('name', DB::raw('count(name)'), DB::raw('GROUP_CONCAT(`id` SEPARATOR ", ") as ids'), DB::raw('GROUP_CONCAT(`type` SEPARATOR ", ")'), DB::raw('Min(`id`) as primary_id'))
        ->where('type', 'variety')
        ->groupBy('name')
        ->havingRaw('count(name) > 1')
        ->get()
//        ->dd()
        ->each(function ($data) {
            $explode = explode(', ', $data->ids);
            $items = collect($explode)->filter(function ($value, $key) use ($data) {
                return $value != $data->primary_id;
            })->all();

            \App\Models\Taxonomy::whereIn('variety_id', $explode)->select('id', 'variety_id', 'updated_at')->update(['variety_id' => $data->primary_id]);

            DB::table('generals')->whereIn('id', $items)->delete();

        }
        );


});
Route::get('medicinal-fix', function () {
    DB::table('medicinal_plants')
        ->select('taxonomy_id', DB::raw('count(taxonomy_id)'),
            DB::raw('GROUP_CONCAT(`id` SEPARATOR ", ") as ids'),
            DB::raw('GROUP_CONCAT(DISTINCT `properties_description` SEPARATOR ", ") as properties_description'),
            DB::raw('GROUP_CONCAT(DISTINCT `compounds` SEPARATOR ", ") as compounds'),
            DB::raw('Min(`id`) as primary_id'))
        ->groupBy('taxonomy_id')
        ->havingRaw('count(taxonomy_id) > 1')
        ->get()
//        ->dd()
        ->each(function ($data) {

            $explode = explode(', ', $data->ids);
            $items = collect($explode)->filter(function ($value, $key) use ($data) {
                return $value != $data->primary_id;
            })->all();

            \App\Models\MedicinalHub::whereIn('medicinal_plant_id', $items)->update(['medicinal_plant_id' => $data->primary_id]);


            DB::table('medicinal_plants')->where('id', $data->primary_id)->update(['compounds' => $data->compounds, 'properties_description' => $data->properties_description]);
            DB::table('medicinal_plants')->whereIn('id', $items)->delete();
        }
        );

});
Route::get('city-fix', function () {
    DB::table('cities')
        ->select('name_en', DB::raw('count(name_en)'), DB::raw('GROUP_CONCAT(`id` SEPARATOR ", ") as ids'), DB::raw('GROUP_CONCAT(`province_id` SEPARATOR ", ") as provinces'), DB::raw('Min(`id`) as primary_id'))
        ->groupBy('name_en')
//        ->groupBy('province_id')
        ->havingRaw('count(name_en) > 1')
        ->get()
        ->dd()
        ->each(function ($data) {
            $explode = explode(', ', $data->ids);
            $items = collect($explode)->filter(function ($value, $key) use ($data) {
                return $value != $data->primary_id;
            })->all();

            \App\Models\Taxonomy::whereIn('species_id', $explode)->select('id', 'species_id', 'updated_at')->update(['species_id' => $data->primary_id]);

            DB::table('generals')->whereIn('id', $items)->delete();

        }
        );


});

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


