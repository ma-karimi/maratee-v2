<?php

namespace App\Observers;


use App\Models\MedicinalLocation;

class MedicinalLocationObserver
{
    /**
     * Handle the protection "created" event.
     *
     * @param MedicinalLocation $medicinalLocation
     * @return void
     */
    public function creating(MedicinalLocation $medicinalLocation)
    {
        if (!empty($this->code)) {
            $lastCode = $this->getLastCode($medicinalLocation);
            $this->code = $lastCode + 1;
        }
    }

    /**
     * @param MedicinalLocation $medicinalLocation
     * @return int
     */
    private function getLastCode(MedicinalLocation $medicinalLocation): int
    {
        $lastMedicinal = $medicinalLocation->where('medicinal_plant_id', $this->medicinal_plant_id)->withTrashed()->latest()->first();

        return $lastMedicinal ? $lastMedicinal->code : 0;
    }

    public function saving(MedicinalLocation $medicinalLocation)
    {
        if (!empty($this->code)) {
            $lastCode = $this->getLastCode($medicinalLocation);
            $this->code = $lastCode + 1;
        }

    }
}
