<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Plant;
use App\Repositories\PlantRepository;

trait MakePlantTrait
{
    /**
     * Create fake instance of Plant and save it in database
     *
     * @param array $plantFields
     * @return Plant
     */
    public function makePlant($plantFields = [])
    {
        /** @var PlantRepository $plantRepo */
        $plantRepo = \App::make(PlantRepository::class);
        $theme = $this->fakePlantData($plantFields);
        return $plantRepo->create($theme);
    }

    /**
     * Get fake instance of Plant
     *
     * @param array $plantFields
     * @return Plant
     */
    public function fakePlant($plantFields = [])
    {
        return new Plant($this->fakePlantData($plantFields));
    }

    /**
     * Get fake data of Plant
     *
     * @param array $plantFields
     * @return array
     */
    public function fakePlantData($plantFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $plantFields);
    }
}
