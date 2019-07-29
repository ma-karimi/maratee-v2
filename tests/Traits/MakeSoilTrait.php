<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Soil;
use App\Repositories\SoilRepository;

trait MakeSoilTrait
{
    /**
     * Create fake instance of Soil and save it in database
     *
     * @param array $soilFields
     * @return Soil
     */
    public function makeSoil($soilFields = [])
    {
        /** @var SoilRepository $soilRepo */
        $soilRepo = \App::make(SoilRepository::class);
        $theme = $this->fakeSoilData($soilFields);
        return $soilRepo->create($theme);
    }

    /**
     * Get fake instance of Soil
     *
     * @param array $soilFields
     * @return Soil
     */
    public function fakeSoil($soilFields = [])
    {
        return new Soil($this->fakeSoilData($soilFields));
    }

    /**
     * Get fake data of Soil
     *
     * @param array $soilFields
     * @return array
     */
    public function fakeSoilData($soilFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $soilFields);
    }
}
