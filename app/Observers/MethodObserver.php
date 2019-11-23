<?php

namespace App\Observers;


use App\Models\Method;
use Illuminate\Support\Facades\Cache;

class MethodObserver
{
    /**
     * Handle the protection "created" event.
     *
     * @param Method $methods
     * @return void
     */
    public function created(Method $methods)
    {
        $this->setCache($methods);
    }

    /**
     * @param Method $methods
     */
    private function setCache(Method $methods): void
    {
        Cache::put('methods', $methods->all(), now()->addDays(10));
    }

    /**
     * Handle the protection "updated" event.
     *
     * @param Method $methods
     * @return void
     */
    public function updated(Method $methods)
    {
        $this->setCache($methods);
    }

    /**
     * Handle the protection "deleted" event.
     *
     * @param Method $methods
     * @return void
     */
    public function deleted(Method $methods)
    {
        $this->setCache($methods);
    }

    /**
     * Handle the protection "restored" event.
     *
     * @param Method $methods
     * @return void
     */
    public function restored(Method $methods)
    {
        $this->setCache($methods);
    }

    /**
     * Handle the protection "force deleted" event.
     *
     * @param Method $methods
     * @return void
     */
    public function forceDeleted(Method $methods)
    {
        $this->setCache($methods);
    }

    public function saved(Method $methods)
    {
        $this->setCache($methods);
    }
}
