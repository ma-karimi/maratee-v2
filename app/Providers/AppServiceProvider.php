<?php

namespace App\Providers;

use App\Models\{City, Country, General, Organization, Plant, Protection, Province, Village};
use App\Observers\{CityObserver,
    CountryObserver,
    GeneralObserver,
    OrganizationObserver,
    PlantObserver,
    ProtectionObserver,
    ProvinceObserver,
    VillageObserver};
use Illuminate\Support\Facades\DB;
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
        if ($this->app->isLocal()) {
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Plant::observe(PlantObserver::class);
        Protection::observe(ProtectionObserver::class);
        General::observe(GeneralObserver::class);
        City::observe(CityObserver::class);
        Province::observe(ProvinceObserver::class);
        Country::observe(CountryObserver::class);
        Village::observe(VillageObserver::class);
        Organization::observe(OrganizationObserver::class);
        DB::getDoctrineSchemaManager()->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');
        DB::getDoctrineSchemaManager()->getDatabasePlatform()->registerDoctrineTypeMapping('point', 'point');
    }
}
