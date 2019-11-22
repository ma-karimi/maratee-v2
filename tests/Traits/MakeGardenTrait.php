<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\InternalHabitat;
use App\Repositories\InternalHabitatRepository;

trait MakeGardenTrait
{
    /**
     * Create fake instance of Garden and save it in database
     *
     * @param array $gardenFields
     * @return InternalHabitat
     */
    public function makeGarden($gardenFields = [])
    {
        /** @var InternalHabitatRepository $gardenRepo */
        $gardenRepo = \App::make(InternalHabitatRepository::class);
        $theme = $this->fakeGardenData($gardenFields);
        return $gardenRepo->create($theme);
    }

    /**
     * Get fake instance of Garden
     *
     * @param array $gardenFields
     * @return InternalHabitat
     */
    public function fakeGarden($gardenFields = [])
    {
        return new InternalHabitat($this->fakeGardenData($gardenFields));
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
