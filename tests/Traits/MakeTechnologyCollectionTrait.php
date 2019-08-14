<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Technology;
use App\Repositories\TechnologyRepository;

trait MakeTechnologyCollectionTrait
{
    /**
     * Create fake instance of TechnologyCollection and save it in database
     *
     * @param array $technologyCollectionFields
     * @return Technology
     */
    public function makeTechnologyCollection($technologyCollectionFields = [])
    {
        /** @var TechnologyRepository $technologyCollectionRepo */
        $technologyCollectionRepo = \App::make(TechnologyRepository::class);
        $theme = $this->fakeTechnologyCollectionData($technologyCollectionFields);
        return $technologyCollectionRepo->create($theme);
    }

    /**
     * Get fake instance of TechnologyCollection
     *
     * @param array $technologyCollectionFields
     * @return Technology
     */
    public function fakeTechnologyCollection($technologyCollectionFields = [])
    {
        return new Technology($this->fakeTechnologyCollectionData($technologyCollectionFields));
    }

    /**
     * Get fake data of TechnologyCollection
     *
     * @param array $technologyCollectionFields
     * @return array
     */
    public function fakeTechnologyCollectionData($technologyCollectionFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $technologyCollectionFields);
    }
}
