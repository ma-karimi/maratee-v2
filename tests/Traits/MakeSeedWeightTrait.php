<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\SeedWeight;
use App\Repositories\SeedWeightRepository;

trait MakeSeedWeightTrait
{
    /**
     * Create fake instance of SeedWeight and save it in database
     *
     * @param array $seedWeightFields
     * @return SeedWeight
     */
    public function makeSeedWeight($seedWeightFields = [])
    {
        /** @var SeedWeightRepository $seedWeightRepo */
        $seedWeightRepo = \App::make(SeedWeightRepository::class);
        $theme = $this->fakeSeedWeightData($seedWeightFields);
        return $seedWeightRepo->create($theme);
    }

    /**
     * Get fake instance of SeedWeight
     *
     * @param array $seedWeightFields
     * @return SeedWeight
     */
    public function fakeSeedWeight($seedWeightFields = [])
    {
        return new SeedWeight($this->fakeSeedWeightData($seedWeightFields));
    }

    /**
     * Get fake data of SeedWeight
     *
     * @param array $seedWeightFields
     * @return array
     */
    public function fakeSeedWeightData($seedWeightFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $seedWeightFields);
    }
}
