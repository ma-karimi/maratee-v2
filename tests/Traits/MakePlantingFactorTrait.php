<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\PlantingFactor;
use App\Repositories\PlantingFactorRepository;

trait MakePlantingFactorTrait
{
    /**
     * Create fake instance of PlantingFactor and save it in database
     *
     * @param array $plantingFactorFields
     * @return PlantingFactor
     */
    public function makePlantingFactor($plantingFactorFields = [])
    {
        /** @var PlantingFactorRepository $plantingFactorRepo */
        $plantingFactorRepo = \App::make(PlantingFactorRepository::class);
        $theme = $this->fakePlantingFactorData($plantingFactorFields);
        return $plantingFactorRepo->create($theme);
    }

    /**
     * Get fake instance of PlantingFactor
     *
     * @param array $plantingFactorFields
     * @return PlantingFactor
     */
    public function fakePlantingFactor($plantingFactorFields = [])
    {
        return new PlantingFactor($this->fakePlantingFactorData($plantingFactorFields));
    }

    /**
     * Get fake data of PlantingFactor
     *
     * @param array $plantingFactorFields
     * @return array
     */
    public function fakePlantingFactorData($plantingFactorFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $plantingFactorFields);
    }
}
