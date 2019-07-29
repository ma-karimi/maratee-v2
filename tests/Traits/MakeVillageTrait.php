<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Village;
use App\Repositories\VillageRepository;

trait MakeVillageTrait
{
    /**
     * Create fake instance of Village and save it in database
     *
     * @param array $villageFields
     * @return Village
     */
    public function makeVillage($villageFields = [])
    {
        /** @var VillageRepository $villageRepo */
        $villageRepo = \App::make(VillageRepository::class);
        $theme = $this->fakeVillageData($villageFields);
        return $villageRepo->create($theme);
    }

    /**
     * Get fake instance of Village
     *
     * @param array $villageFields
     * @return Village
     */
    public function fakeVillage($villageFields = [])
    {
        return new Village($this->fakeVillageData($villageFields));
    }

    /**
     * Get fake data of Village
     *
     * @param array $villageFields
     * @return array
     */
    public function fakeVillageData($villageFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $villageFields);
    }
}
