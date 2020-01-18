<?php

namespace App\Observers;

use App\Models\General;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class GeneralObserver
{

    /**
     * Handle the general "created" event.
     *
     * @param
     * @return void
     */
    public function created()
    {
        $this->setCache();
    }

    /**
     */
    private function setCache(): void
    {
        Artisan::call('modelCache:clear --model=App\\\Models\\\General');
    }

    /**
     * Handle the general "updated" event.
     *
     * @param
     * @return void
     */
    public function updated()
    {
        $this->setCache();
    }

    /**
     * Handle the general "deleted" event.
     *
     * @param
     * @return void
     */
    public function deleted()
    {
        $this->setCache();
    }

    /**
     * Handle the general "restored" event.
     *
     * @param
     * @return void
     */
    public function restored()
    {
        $this->setCache();
    }

    /**
     * Handle the general "force deleted" event.
     *
     * @param
     * @return void
     */
    public function forceDeleted()
    {
        $this->setCache();
    }

    /**
     * Handle the general "saved" event.
     *
     * @param
     * @return void
     */
    public function saved()
    {
        $this->setCache();
    }
}
