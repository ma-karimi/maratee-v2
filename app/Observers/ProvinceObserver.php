<?php

namespace App\Observers;


use App\Models\City;
use App\Models\Country;
use App\Models\Province;
use Illuminate\Support\Facades\Cache;

class ProvinceObserver
{
    /**
     * Handle the protection "created" event.
     *
     * @param Province $province
     * @return void
     */
    public function created(Province $province)
    {
        $this->setCache($province);
    }

    /**
     * @param Province $province
     */
    private function setCache(Province $province): void
    {
        Cache::put('provinces', $province->all(), now()->addDays(10));
        Cache::put('countries', Country::all()->load('provinces.cities'), now()->addDays(10));
        Cache::put('cities', City::all(), now()->addDays(10));
    }

    /**
     * Handle the protection "updated" event.
     *
     * @param Province $province
     * @return void
     */
    public function updated(Province $province)
    {
        $this->setCache($province);
    }

    /**
     * Handle the protection "deleted" event.
     *
     * @param Province $province
     * @return void
     */
    public function deleted(Province $province)
    {
        $this->setCache($province);
    }

    /**
     * Handle the protection "restored" event.
     *
     * @param Province $province
     * @return void
     */
    public function restored(Province $province)
    {
        $this->setCache($province);
    }

    /**
     * Handle the protection "force deleted" event.
     *
     * @param Province $province
     * @return void
     */
    public function forceDeleted(Province $province)
    {
        $this->setCache($province);
    }

    public function saved(Province $province)
    {
        $this->setCache($province);
    }
}
