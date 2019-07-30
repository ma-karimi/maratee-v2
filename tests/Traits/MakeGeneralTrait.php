<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\General;
use App\Repositories\PlantGeneralRepository;

trait MakeGeneralTrait
{
    /**
     * Create fake instance of General and save it in database
     *
     * @param array $plantingGeneralFields
     * @return General
     */
    public function makeGeneral($plantingGeneralFields = [])
    {
        /** @var PlantGeneralRepository $plantingGeneralRepo */
        $plantingGeneralRepo = \App::make(PlantGeneralRepository::class);
        $theme = $this->fakeGeneralData($plantingGeneralFields);
        return $plantingGeneralRepo->create($theme);
    }

    /**
     * Get fake instance of General
     *
     * @param array $plantingGeneralFields
     * @return General
     */
    public function fakeGeneral($plantingGeneralFields = [])
    {
        return new General($this->fakeGeneralData($plantingGeneralFields));
    }

    /**
     * Get fake data of General
     *
     * @param array $plantingGeneralFields
     * @return array
     */
    public function fakeGeneralData($plantingGeneralFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $plantingGeneralFields);
    }
}
