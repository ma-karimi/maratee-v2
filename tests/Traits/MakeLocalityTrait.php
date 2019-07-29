<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Locality;
use App\Repositories\LocalityRepository;

trait MakeLocalityTrait
{
    /**
     * Create fake instance of Locality and save it in database
     *
     * @param array $localityFields
     * @return Locality
     */
    public function makeLocality($localityFields = [])
    {
        /** @var LocalityRepository $localityRepo */
        $localityRepo = \App::make(LocalityRepository::class);
        $theme = $this->fakeLocalityData($localityFields);
        return $localityRepo->create($theme);
    }

    /**
     * Get fake instance of Locality
     *
     * @param array $localityFields
     * @return Locality
     */
    public function fakeLocality($localityFields = [])
    {
        return new Locality($this->fakeLocalityData($localityFields));
    }

    /**
     * Get fake data of Locality
     *
     * @param array $localityFields
     * @return array
     */
    public function fakeLocalityData($localityFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $localityFields);
    }
}
