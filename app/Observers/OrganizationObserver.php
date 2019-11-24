<?php

namespace App\Observers;


use App\Models\Organization;
use Illuminate\Support\Facades\Cache;

class OrganizationObserver
{
    /**
     * Handle the protection "created" event.
     *
     * @param Organization $organization
     * @return void
     */
    public function created(Organization $organization)
    {
        $this->setCache($organization);
    }

    /**
     * @param Organization $organization
     */
    private function setCache(Organization $organization): void
    {
        Cache::put('protections', $organization->all(), now()->addDays(10));
    }

    /**
     * Handle the protection "updated" event.
     *
     * @param Organization $organization
     * @return void
     */
    public function updated(Organization $organization)
    {
        $this->setCache($organization);
    }

    /**
     * Handle the protection "deleted" event.
     *
     * @param Organization $organization
     * @return void
     */
    public function deleted(Organization $organization)
    {
        $this->setCache($organization);
    }

    /**
     * Handle the protection "restored" event.
     *
     * @param Organization $organization
     * @return void
     */
    public function restored(Organization $organization)
    {
        $this->setCache($organization);
    }

    /**
     * Handle the protection "force deleted" event.
     *
     * @param Organization $organization
     * @return void
     */
    public function forceDeleted(Organization $organization)
    {
        $this->setCache($organization);
    }

    public function saved(Organization $organization)
    {
        $this->setCache($organization);
    }
}
