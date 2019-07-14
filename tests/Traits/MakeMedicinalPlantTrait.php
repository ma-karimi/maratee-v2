<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\MedicinalPlant;
use App\Repositories\MedicinalPlantRepository;

trait MakeMedicinalPlantTrait
{
    /**
     * Create fake instance of MedicinalPlant and save it in database
     *
     * @param array $medicinalPlantFields
     * @return MedicinalPlant
     */
    public function makeMedicinalPlant($medicinalPlantFields = [])
    {
        /** @var MedicinalPlantRepository $medicinalPlantRepo */
        $medicinalPlantRepo = \App::make(MedicinalPlantRepository::class);
        $theme = $this->fakeMedicinalPlantData($medicinalPlantFields);
        return $medicinalPlantRepo->create($theme);
    }

    /**
     * Get fake instance of MedicinalPlant
     *
     * @param array $medicinalPlantFields
     * @return MedicinalPlant
     */
    public function fakeMedicinalPlant($medicinalPlantFields = [])
    {
        return new MedicinalPlant($this->fakeMedicinalPlantData($medicinalPlantFields));
    }

    /**
     * Get fake data of MedicinalPlant
     *
     * @param array $medicinalPlantFields
     * @return array
     */
    public function fakeMedicinalPlantData($medicinalPlantFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $medicinalPlantFields);
    }
}
