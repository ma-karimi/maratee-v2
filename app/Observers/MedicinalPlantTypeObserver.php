<?php

namespace App\Observers;


use App\Models\MedicinalPlantType;
use Illuminate\Support\Facades\Cache;

class MedicinalPlantTypeObserver
{
    /**
     * Handle the protection "created" event.
     *
     * @param MedicinalPlantType $medicinal_plant_types
     * @return void
     */
    public function created(MedicinalPlantType $medicinal_plant_types)
    {
        $this->setCache($medicinal_plant_types);
    }

    /**
     * @param MedicinalPlantType $medicinal_plant_types
     */
    private function setCache(MedicinalPlantType $medicinal_plant_types): void
    {
        Cache::put('medicinal_plant_types', $medicinal_plant_types->all(), now()->addDays(10));
    }

    /**
     * Handle the protection "updated" event.
     *
     * @param MedicinalPlantType $medicinal_plant_types
     * @return void
     */
    public function updated(MedicinalPlantType $medicinal_plant_types)
    {
        $this->setCache($medicinal_plant_types);
    }

    /**
     * Handle the protection "deleted" event.
     *
     * @param MedicinalPlantType $medicinal_plant_types
     * @return void
     */
    public function deleted(MedicinalPlantType $medicinal_plant_types)
    {
        $this->setCache($medicinal_plant_types);
    }

    /**
     * Handle the protection "restored" event.
     *
     * @param MedicinalPlantType $medicinal_plant_types
     * @return void
     */
    public function restored(MedicinalPlantType $medicinal_plant_types)
    {
        $this->setCache($medicinal_plant_types);
    }

    /**
     * Handle the protection "force deleted" event.
     *
     * @param MedicinalPlantType $medicinal_plant_types
     * @return void
     */
    public function forceDeleted(MedicinalPlantType $medicinal_plant_types)
    {
        $this->setCache($medicinal_plant_types);
    }

    public function saved(MedicinalPlantType $medicinal_plant_types)
    {
        $this->setCache($medicinal_plant_types);
    }
}
