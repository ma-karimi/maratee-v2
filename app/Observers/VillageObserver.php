<?php

namespace App\Observers;


use App\Models\Village;
use Illuminate\Support\Facades\Cache;

class VillageObserver
{
    /**
     * Handle the protection "created" event.
     *
     * @param Village $village
     * @return void
     */
    public function created(Village $village)
    {
        $this->setCache($village);
    }

    /**
     * @param Village $village
     */
    private function setCache(Village $village): void
    {
        Cache::put('protections', $village->all(), now()->addDays(10));
    }

    /**
     * Handle the protection "updated" event.
     *
     * @param Village $village
     * @return void
     */
    public function updated(Village $village)
    {
        $this->setCache($village);
    }

    /**
     * Handle the protection "deleted" event.
     *
     * @param Village $village
     * @return void
     */
    public function deleted(Village $village)
    {
        $this->setCache($village);
    }

    /**
     * Handle the protection "restored" event.
     *
     * @param Village $village
     * @return void
     */
    public function restored(Village $village)
    {
        $this->setCache($village);
    }

    /**
     * Handle the protection "force deleted" event.
     *
     * @param Village $village
     * @return void
     */
    public function forceDeleted(Village $village)
    {
        $this->setCache($village);
    }

    public function saved(Village $village)
    {
        $this->setCache($village);
    }
}
