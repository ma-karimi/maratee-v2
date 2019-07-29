<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\SeedPlant;
use App\Repositories\SeedPlantRepository;

trait MakeSeedPlantTrait
{
    /**
     * Create fake instance of SeedPlant and save it in database
     *
     * @param array $seedPlantFields
     * @return SeedPlant
     */
    public function makeSeedPlant($seedPlantFields = [])
    {
        /** @var SeedPlantRepository $seedPlantRepo */
        $seedPlantRepo = \App::make(SeedPlantRepository::class);
        $theme = $this->fakeSeedPlantData($seedPlantFields);
        return $seedPlantRepo->create($theme);
    }

    /**
     * Get fake instance of SeedPlant
     *
     * @param array $seedPlantFields
     * @return SeedPlant
     */
    public function fakeSeedPlant($seedPlantFields = [])
    {
        return new SeedPlant($this->fakeSeedPlantData($seedPlantFields));
    }

    /**
     * Get fake data of SeedPlant
     *
     * @param array $seedPlantFields
     * @return array
     */
    public function fakeSeedPlantData($seedPlantFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $seedPlantFields);
    }
}
