<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\GeologyAge;
use App\Repositories\GeologyAgeRepository;

trait MakeGeologyAgeTrait
{
    /**
     * Create fake instance of GeologyAge and save it in database
     *
     * @param array $geologyAgeFields
     * @return GeologyAge
     */
    public function makeGeologyAge($geologyAgeFields = [])
    {
        /** @var GeologyAgeRepository $geologyAgeRepo */
        $geologyAgeRepo = \App::make(GeologyAgeRepository::class);
        $theme = $this->fakeGeologyAgeData($geologyAgeFields);
        return $geologyAgeRepo->create($theme);
    }

    /**
     * Get fake instance of GeologyAge
     *
     * @param array $geologyAgeFields
     * @return GeologyAge
     */
    public function fakeGeologyAge($geologyAgeFields = [])
    {
        return new GeologyAge($this->fakeGeologyAgeData($geologyAgeFields));
    }

    /**
     * Get fake data of GeologyAge
     *
     * @param array $geologyAgeFields
     * @return array
     */
    public function fakeGeologyAgeData($geologyAgeFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $geologyAgeFields);
    }
}
