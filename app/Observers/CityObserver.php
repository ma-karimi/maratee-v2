<?php

namespace App\Observers;


use App\Models\City;
use App\Models\Country;
use App\Models\Province;
use Illuminate\Support\Facades\Cache;

class CityObserver
{
    /**
     * Handle the protection "created" event.
     *
     * @param City $city
     * @return void
     */
    public function created(City $city)
    {
        $this->setCache($city);
    }

    /**
     * @param City $city
     */
    private function setCache(City $city): void
    {
        Cache::put('cities', $city->all(), now()->addDays(10));
        Cache::put('provinces', Province::all(), now()->addDays(10));
        Cache::put('countries', Country::all()->load('provinces.cities'), now()->addDays(10));
    }

    /**
     * Handle the protection "updated" event.
     *
     * @param City $city
     * @return void
     */
    public function updated(City $city)
    {
        $this->setCache($city);
    }

    /**
     * Handle the protection "deleted" event.
     *
     * @param City $city
     * @return void
     */
    public function deleted(City $city)
    {
        $this->setCache($city);
    }

    /**
     * Handle the protection "restored" event.
     *
     * @param City $city
     * @return void
     */
    public function restored(City $city)
    {
        $this->setCache($city);
    }

    /**
     * Handle the protection "force deleted" event.
     *
     * @param City $city
     * @return void
     */
    public function forceDeleted(City $city)
    {
        $this->setCache($city);
    }

    public function saved(City $city)
    {
        $this->setCache($city);
    }
}
