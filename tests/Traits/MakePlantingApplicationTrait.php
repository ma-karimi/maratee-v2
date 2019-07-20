<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\PlantingApplication;
use App\Repositories\PlantApplicationRepository;

trait MakePlantingApplicationTrait
{
    /**
     * Create fake instance of PlantingApplication and save it in database
     *
     * @param array $plantingApplicationFields
     * @return PlantingApplication
     */
    public function makePlantingApplication($plantingApplicationFields = [])
    {
        /** @var PlantApplicationRepository $plantingApplicationRepo */
        $plantingApplicationRepo = \App::make(PlantApplicationRepository::class);
        $theme = $this->fakePlantingApplicationData($plantingApplicationFields);
        return $plantingApplicationRepo->create($theme);
    }

    /**
     * Get fake instance of PlantingApplication
     *
     * @param array $plantingApplicationFields
     * @return PlantingApplication
     */
    public function fakePlantingApplication($plantingApplicationFields = [])
    {
        return new PlantingApplication($this->fakePlantingApplicationData($plantingApplicationFields));
    }

    /**
     * Get fake data of PlantingApplication
     *
     * @param array $plantingApplicationFields
     * @return array
     */
    public function fakePlantingApplicationData($plantingApplicationFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $plantingApplicationFields);
    }
}
