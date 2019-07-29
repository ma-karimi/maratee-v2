<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\SoilFeature;
use App\Repositories\SoilFeatureRepository;

trait MakeSoilFeatureTrait
{
    /**
     * Create fake instance of SoilFeature and save it in database
     *
     * @param array $soilFeatureFields
     * @return SoilFeature
     */
    public function makeSoilFeature($soilFeatureFields = [])
    {
        /** @var SoilFeatureRepository $soilFeatureRepo */
        $soilFeatureRepo = \App::make(SoilFeatureRepository::class);
        $theme = $this->fakeSoilFeatureData($soilFeatureFields);
        return $soilFeatureRepo->create($theme);
    }

    /**
     * Get fake instance of SoilFeature
     *
     * @param array $soilFeatureFields
     * @return SoilFeature
     */
    public function fakeSoilFeature($soilFeatureFields = [])
    {
        return new SoilFeature($this->fakeSoilFeatureData($soilFeatureFields));
    }

    /**
     * Get fake data of SoilFeature
     *
     * @param array $soilFeatureFields
     * @return array
     */
    public function fakeSoilFeatureData($soilFeatureFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $soilFeatureFields);
    }
}
