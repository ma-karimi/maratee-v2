<?php

namespace App\Observers;


use App\Models\Protection;
use Illuminate\Support\Facades\Cache;

class ProtectionObserver
{
    /**
     * Handle the protection "created" event.
     *
     * @param Protection $protection
     * @return void
     */
    public function created(Protection $protection)
    {
        $this->setCache($protection);
    }

    /**
     * @param Protection $protection
     */
    private function setCache(Protection $protection): void
    {
        Cache::put('protections', $protection->all(), now()->addDays(10));
    }

    /**
     * Handle the protection "updated" event.
     *
     * @param Protection $protection
     * @return void
     */
    public function updated(Protection $protection)
    {
        $this->setCache($protection);
    }

    /**
     * Handle the protection "deleted" event.
     *
     * @param Protection $protection
     * @return void
     */
    public function deleted(Protection $protection)
    {
        $this->setCache($protection);
    }

    /**
     * Handle the protection "restored" event.
     *
     * @param Protection $protection
     * @return void
     */
    public function restored(Protection $protection)
    {
        $this->setCache($protection);
    }

    /**
     * Handle the protection "force deleted" event.
     *
     * @param Protection $protection
     * @return void
     */
    public function forceDeleted(Protection $protection)
    {
        $this->setCache($protection);
    }

    public function saved(Protection $protection)
    {
        $this->setCache($protection);
    }
}
