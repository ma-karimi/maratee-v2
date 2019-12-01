<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\PaleontologyMap;
use App\Repositories\PaleontologyMapRepository;

trait MakeMapTrait
{
    /**
     * Create fake instance of Map and save it in database
     *
     * @param array $mapFields
     * @return PaleontologyMap
     */
    public function makeMap($mapFields = [])
    {
        /** @var PaleontologyMapRepository $mapRepo */
        $mapRepo = \App::make(PaleontologyMapRepository::class);
        $theme = $this->fakeMapData($mapFields);
        return $mapRepo->create($theme);
    }

    /**
     * Get fake instance of Map
     *
     * @param array $mapFields
     * @return PaleontologyMap
     */
    public function fakeMap($mapFields = [])
    {
        return new PaleontologyMap($this->fakeMapData($mapFields));
    }

    /**
     * Get fake data of Map
     *
     * @param array $mapFields
     * @return array
     */
    public function fakeMapData($mapFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $mapFields);
    }
}
