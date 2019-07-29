<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\SeedTechnology;
use App\Repositories\SeedTechnologyRepository;

trait MakeSeedTechnologyTrait
{
    /**
     * Create fake instance of SeedTechnology and save it in database
     *
     * @param array $seedTechnologyFields
     * @return SeedTechnology
     */
    public function makeSeedTechnology($seedTechnologyFields = [])
    {
        /** @var SeedTechnologyRepository $seedTechnologyRepo */
        $seedTechnologyRepo = \App::make(SeedTechnologyRepository::class);
        $theme = $this->fakeSeedTechnologyData($seedTechnologyFields);
        return $seedTechnologyRepo->create($theme);
    }

    /**
     * Get fake instance of SeedTechnology
     *
     * @param array $seedTechnologyFields
     * @return SeedTechnology
     */
    public function fakeSeedTechnology($seedTechnologyFields = [])
    {
        return new SeedTechnology($this->fakeSeedTechnologyData($seedTechnologyFields));
    }

    /**
     * Get fake data of SeedTechnology
     *
     * @param array $seedTechnologyFields
     * @return array
     */
    public function fakeSeedTechnologyData($seedTechnologyFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $seedTechnologyFields);
    }
}
