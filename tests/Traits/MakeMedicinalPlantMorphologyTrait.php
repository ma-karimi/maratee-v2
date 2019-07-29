<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\MedicinalPlantMorphology;
use App\Repositories\MedicinalPlantMorphologyRepository;

trait MakeMedicinalPlantMorphologyTrait
{
    /**
     * Create fake instance of MedicinalPlantMorphology and save it in database
     *
     * @param array $medicinalPlantMorphologyFields
     * @return MedicinalPlantMorphology
     */
    public function makeMedicinalPlantMorphology($medicinalPlantMorphologyFields = [])
    {
        /** @var MedicinalPlantMorphologyRepository $medicinalPlantMorphologyRepo */
        $medicinalPlantMorphologyRepo = \App::make(MedicinalPlantMorphologyRepository::class);
        $theme = $this->fakeMedicinalPlantMorphologyData($medicinalPlantMorphologyFields);
        return $medicinalPlantMorphologyRepo->create($theme);
    }

    /**
     * Get fake instance of MedicinalPlantMorphology
     *
     * @param array $medicinalPlantMorphologyFields
     * @return MedicinalPlantMorphology
     */
    public function fakeMedicinalPlantMorphology($medicinalPlantMorphologyFields = [])
    {
        return new MedicinalPlantMorphology($this->fakeMedicinalPlantMorphologyData($medicinalPlantMorphologyFields));
    }

    /**
     * Get fake data of MedicinalPlantMorphology
     *
     * @param array $medicinalPlantMorphologyFields
     * @return array
     */
    public function fakeMedicinalPlantMorphologyData($medicinalPlantMorphologyFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $medicinalPlantMorphologyFields);
    }
}
