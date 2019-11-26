<?php

namespace App\Observers;


use App\Models\Country;
use Illuminate\Support\Facades\Cache;

class CountryObserver
{
    /**
     * Handle the protection "created" event.
     *
     * @param Country $countries
     * @return void
     */
    public function created(Country $countries)
    {
        $this->setCache($countries);
    }

    /**
     * @param Country $countries
     */
    private function setCache(Country $countries): void
    {
        Cache::put('countries', $countries->all()->load('provinces.cities'), now()->addDays(10));
    }

    /**
     * Handle the protection "updated" event.
     *
     * @param Country $countries
     * @return void
     */
    public function updated(Country $countries)
    {
        $this->setCache($countries);
    }

    /**
     * Handle the protection "deleted" event.
     *
     * @param Country $countries
     * @return void
     */
    public function deleted(Country $countries)
    {
        $this->setCache($countries);
    }

    /**
     * Handle the protection "restored" event.
     *
     * @param Country $countries
     * @return void
     */
    public function restored(Country $countries)
    {
        $this->setCache($countries);
    }

    /**
     * Handle the protection "force deleted" event.
     *
     * @param Country $countries
     * @return void
     */
    public function forceDeleted(Country $countries)
    {
        $this->setCache($countries);
    }

    public function saved(Country $countries)
    {
        $this->setCache($countries);
    }
}
