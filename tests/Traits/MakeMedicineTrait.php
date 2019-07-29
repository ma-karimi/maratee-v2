<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Medicine;
use App\Repositories\MedicineRepository;

trait MakeMedicineTrait
{
    /**
     * Create fake instance of Medicine and save it in database
     *
     * @param array $medicineFields
     * @return Medicine
     */
    public function makeMedicine($medicineFields = [])
    {
        /** @var MedicineRepository $medicineRepo */
        $medicineRepo = \App::make(MedicineRepository::class);
        $theme = $this->fakeMedicineData($medicineFields);
        return $medicineRepo->create($theme);
    }

    /**
     * Get fake instance of Medicine
     *
     * @param array $medicineFields
     * @return Medicine
     */
    public function fakeMedicine($medicineFields = [])
    {
        return new Medicine($this->fakeMedicineData($medicineFields));
    }

    /**
     * Get fake data of Medicine
     *
     * @param array $medicineFields
     * @return array
     */
    public function fakeMedicineData($medicineFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $medicineFields);
    }
}
