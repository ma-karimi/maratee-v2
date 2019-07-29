<?php

namespace App\Providers;

use App\Models\Plant;
use App\Observers\PlantObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Plant::observe(PlantObserver::class);
    }
}
