<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Division;
use App\Repositories\DivisionRepository;

trait MakeDivisionTrait
{
    /**
     * Create fake instance of Division and save it in database
     *
     * @param array $divisionFields
     * @return Division
     */
    public function makeDivision($divisionFields = [])
    {
        /** @var DivisionRepository $divisionRepo */
        $divisionRepo = \App::make(DivisionRepository::class);
        $theme = $this->fakeDivisionData($divisionFields);
        return $divisionRepo->create($theme);
    }

    /**
     * Get fake instance of Division
     *
     * @param array $divisionFields
     * @return Division
     */
    public function fakeDivision($divisionFields = [])
    {
        return new Division($this->fakeDivisionData($divisionFields));
    }

    /**
     * Get fake data of Division
     *
     * @param array $divisionFields
     * @return array
     */
    public function fakeDivisionData($divisionFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $divisionFields);
    }
}
