<?php

namespace App\Observers;

use App\Models\General;
use Illuminate\Support\Facades\Cache;

class GeneralObserver
{
    public $types = ['family', 'genus', 'phytogeography', 'species', 'sub_species', 'variety', 'habitat', 'origin', 'lichen', 'moss', 'diatom', 'ecology'];
    /**
     * Handle the general "created" event.
     *
     * @param General $general
     * @return void
     */
    public function created(General $general)
    {
        $this->setCache($general, $this->types);
    }

    /**
     * @param General $general
     * @param $types
     */
    private function setCache(General $general, array $types): void
    {
        foreach ($types as $type) {
            Cache::put($type, $general->whereType($type)->get(), now()->addDays(10));
        }
    }

    /**
     * Handle the general "updated" event.
     *
     * @param General $general
     * @return void
     */
    public function updated(General $general)
    {
        $this->setCache($general, $this->types);
    }

    /**
     * Handle the general "deleted" event.
     *
     * @param General $general
     * @return void
     */
    public function deleted(General $general)
    {
        $this->setCache($general, $this->types);
    }

    /**
     * Handle the general "restored" event.
     *
     * @param General $general
     * @return void
     */
    public function restored(General $general)
    {
        $this->setCache($general, $this->types);
    }

    /**
     * Handle the general "force deleted" event.
     *
     * @param General $general
     * @return void
     */
    public function forceDeleted(General $general)
    {
        $this->setCache($general, $this->types);
    }

    /**
     * Handle the general "saved" event.
     *
     * @param General $general
     * @return void
     */
    public function saved(General $general)
    {
        $this->setCache($general, $this->types);
    }
}
