<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Continent;
use App\Repositories\ContinentRepository;

trait MakeContinentTrait
{
    /**
     * Create fake instance of Continent and save it in database
     *
     * @param array $continentFields
     * @return Continent
     */
    public function makeContinent($continentFields = [])
    {
        /** @var ContinentRepository $continentRepo */
        $continentRepo = \App::make(ContinentRepository::class);
        $theme = $this->fakeContinentData($continentFields);
        return $continentRepo->create($theme);
    }

    /**
     * Get fake instance of Continent
     *
     * @param array $continentFields
     * @return Continent
     */
    public function fakeContinent($continentFields = [])
    {
        return new Continent($this->fakeContinentData($continentFields));
    }

    /**
     * Get fake data of Continent
     *
     * @param array $continentFields
     * @return array
     */
    public function fakeContinentData($continentFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $continentFields);
    }
}
