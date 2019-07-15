<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Garden;
use App\Repositories\GardenRepository;

trait MakeGardenTrait
{
    /**
     * Create fake instance of Garden and save it in database
     *
     * @param array $gardenFields
     * @return Garden
     */
    public function makeGarden($gardenFields = [])
    {
        /** @var GardenRepository $gardenRepo */
        $gardenRepo = \App::make(GardenRepository::class);
        $theme = $this->fakeGardenData($gardenFields);
        return $gardenRepo->create($theme);
    }

    /**
     * Get fake instance of Garden
     *
     * @param array $gardenFields
     * @return Garden
     */
    public function fakeGarden($gardenFields = [])
    {
        return new Garden($this->fakeGardenData($gardenFields));
    }

    /**
     * Get fake data of Garden
     *
     * @param array $gardenFields
     * @return array
     */
    public function fakeGardenData($gardenFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $gardenFields);
    }
}
