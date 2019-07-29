<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\SeedHasPlant;
use App\Repositories\SeedHasPlantRepository;

trait MakeSeedHasPlantTrait
{
    /**
     * Create fake instance of SeedHasPlant and save it in database
     *
     * @param array $seedHasPlantFields
     * @return SeedHasPlant
     */
    public function makeSeedHasPlant($seedHasPlantFields = [])
    {
        /** @var SeedHasPlantRepository $seedHasPlantRepo */
        $seedHasPlantRepo = \App::make(SeedHasPlantRepository::class);
        $theme = $this->fakeSeedHasPlantData($seedHasPlantFields);
        return $seedHasPlantRepo->create($theme);
    }

    /**
     * Get fake instance of SeedHasPlant
     *
     * @param array $seedHasPlantFields
     * @return SeedHasPlant
     */
    public function fakeSeedHasPlant($seedHasPlantFields = [])
    {
        return new SeedHasPlant($this->fakeSeedHasPlantData($seedHasPlantFields));
    }

    /**
     * Get fake data of SeedHasPlant
     *
     * @param array $seedHasPlantFields
     * @return array
     */
    public function fakeSeedHasPlantData($seedHasPlantFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $seedHasPlantFields);
    }
}
