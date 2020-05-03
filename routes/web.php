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

use Illuminate\Support\Str;


Route::get('/test-general', function () {
    $General = App\Models\General::all()->groupBy('type');

    foreach ($General as $index => $item){
        $General[$index] = collect($item)->sortBy('name')->take(10)->values()->all();
    }
    return response()->json($General);
});

Route::get('/', function () {
    $name = Str::singular(Str::studly('medicinal_locations'));
    $repo = 'App\\Repositories\\' . $name . 'Repository';
    $repo = resolve($repo);
    \Log::info($repo->model()::getAllRelations());
    $result = $repo->all()->load(Arr::flatten($repo->model()::getAllRelations()));
    dd($result);
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


