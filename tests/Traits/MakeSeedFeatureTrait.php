<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\seedFeature;
use App\Repositories\seedFeatureRepository;

trait MakeseedFeatureTrait
{
    /**
     * Create fake instance of seedFeature and save it in database
     *
     * @param array $seedFeatureFields
     * @return seedFeature
     */
    public function makeseedFeature($seedFeatureFields = [])
    {
        /** @var seedFeatureRepository $seedFeatureRepo */
        $seedFeatureRepo = \App::make(seedFeatureRepository::class);
        $theme = $this->fakeseedFeatureData($seedFeatureFields);
        return $seedFeatureRepo->create($theme);
    }

    /**
     * Get fake instance of seedFeature
     *
     * @param array $seedFeatureFields
     * @return seedFeature
     */
    public function fakeseedFeature($seedFeatureFields = [])
    {
        return new seedFeature($this->fakeseedFeatureData($seedFeatureFields));
    }

    /**
     * Get fake data of seedFeature
     *
     * @param array $seedFeatureFields
     * @return array
     */
    public function fakeseedFeatureData($seedFeatureFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $seedFeatureFields);
    }
}
