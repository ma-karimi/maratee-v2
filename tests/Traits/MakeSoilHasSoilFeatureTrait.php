<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\SoilHasSoilFeature;
use App\Repositories\SoilHasSoilFeatureRepository;

trait MakeSoilHasSoilFeatureTrait
{
    /**
     * Create fake instance of SoilHasSoilFeature and save it in database
     *
     * @param array $soilHasSoilFeatureFields
     * @return SoilHasSoilFeature
     */
    public function makeSoilHasSoilFeature($soilHasSoilFeatureFields = [])
    {
        /** @var SoilHasSoilFeatureRepository $soilHasSoilFeatureRepo */
        $soilHasSoilFeatureRepo = \App::make(SoilHasSoilFeatureRepository::class);
        $theme = $this->fakeSoilHasSoilFeatureData($soilHasSoilFeatureFields);
        return $soilHasSoilFeatureRepo->create($theme);
    }

    /**
     * Get fake instance of SoilHasSoilFeature
     *
     * @param array $soilHasSoilFeatureFields
     * @return SoilHasSoilFeature
     */
    public function fakeSoilHasSoilFeature($soilHasSoilFeatureFields = [])
    {
        return new SoilHasSoilFeature($this->fakeSoilHasSoilFeatureData($soilHasSoilFeatureFields));
    }

    /**
     * Get fake data of SoilHasSoilFeature
     *
     * @param array $soilHasSoilFeatureFields
     * @return array
     */
    public function fakeSoilHasSoilFeatureData($soilHasSoilFeatureFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $soilHasSoilFeatureFields);
    }
}
