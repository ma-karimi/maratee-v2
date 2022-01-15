<?php

namespace App\Providers;

use App\Models\{SeedExchange};
use App\Observers\{SeedExchangeObserver};
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
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
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

//            General::observe(GeneralObserver::class);
//        if (App::environment() == 'production') {
//            Plant::observe(PlantObserver::class);
//            Protection::observe(ProtectionObserver::class);
//            City::observe(CityObserver::class);
//            Province::observe(ProvinceObserver::class);
//            Country::observe(CountryObserver::class);
//            Organization::observe(OrganizationObserver::class);
//            MedicinalPlantType::observe(MedicinalPlantTypeObserver::class);
//            Method::observe(MethodObserver::class);
//            Medicine::observe(MedicineObserver::class);
//            Product::observe(ProductObserver::class);
//        }
        SeedExchange::observe(SeedExchangeObserver::class);

        DB::getDoctrineSchemaManager()->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');
        DB::getDoctrineSchemaManager()->getDatabasePlatform()->registerDoctrineTypeMapping('point', 'point');
    }
}
