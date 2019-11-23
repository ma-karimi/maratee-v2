<?php

namespace App\Observers;


use App\Models\Medicine;
use Illuminate\Support\Facades\Cache;

class MedicineObserver
{
    /**
     * Handle the protection "created" event.
     *
     * @param Medicine $medicne
     * @return void
     */
    public function created(Medicine $medicne)
    {
        $this->setCache($medicne);
    }

    /**
     * @param Medicine $medicne
     */
    private function setCache(Medicine $medicne): void
    {
        Cache::put('medicine', $medicne->all(), now()->addDays(10));
    }

    /**
     * Handle the protection "updated" event.
     *
     * @param Medicine $medicne
     * @return void
     */
    public function updated(Medicine $medicne)
    {
        $this->setCache($medicne);
    }

    /**
     * Handle the protection "deleted" event.
     *
     * @param Medicine $medicne
     * @return void
     */
    public function deleted(Medicine $medicne)
    {
        $this->setCache($medicne);
    }

    /**
     * Handle the protection "restored" event.
     *
     * @param Medicine $medicne
     * @return void
     */
    public function restored(Medicine $medicne)
    {
        $this->setCache($medicne);
    }

    /**
     * Handle the protection "force deleted" event.
     *
     * @param Medicine $medicne
     * @return void
     */
    public function forceDeleted(Medicine $medicne)
    {
        $this->setCache($medicne);
    }

    public function saved(Medicine $medicne)
    {
        $this->setCache($medicne);
    }
}
