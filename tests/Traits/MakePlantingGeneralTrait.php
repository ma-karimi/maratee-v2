<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\PlantingGeneral;
use App\Repositories\PlantGeneralRepository;

trait MakePlantingGeneralTrait
{
    /**
     * Create fake instance of PlantingGeneral and save it in database
     *
     * @param array $plantingGeneralFields
     * @return PlantingGeneral
     */
    public function makePlantingGeneral($plantingGeneralFields = [])
    {
        /** @var PlantGeneralRepository $plantingGeneralRepo */
        $plantingGeneralRepo = \App::make(PlantGeneralRepository::class);
        $theme = $this->fakePlantingGeneralData($plantingGeneralFields);
        return $plantingGeneralRepo->create($theme);
    }

    /**
     * Get fake instance of PlantingGeneral
     *
     * @param array $plantingGeneralFields
     * @return PlantingGeneral
     */
    public function fakePlantingGeneral($plantingGeneralFields = [])
    {
        return new PlantingGeneral($this->fakePlantingGeneralData($plantingGeneralFields));
    }

    /**
     * Get fake data of PlantingGeneral
     *
     * @param array $plantingGeneralFields
     * @return array
     */
    public function fakePlantingGeneralData($plantingGeneralFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $plantingGeneralFields);
    }
}
