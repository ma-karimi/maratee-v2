<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Dimension;
use App\Repositories\DimensionRepository;

trait MakeDimensionTrait
{
    /**
     * Create fake instance of Dimension and save it in database
     *
     * @param array $dimensionFields
     * @return Dimension
     */
    public function makeDimension($dimensionFields = [])
    {
        /** @var DimensionRepository $dimensionRepo */
        $dimensionRepo = \App::make(DimensionRepository::class);
        $theme = $this->fakeDimensionData($dimensionFields);
        return $dimensionRepo->create($theme);
    }

    /**
     * Get fake instance of Dimension
     *
     * @param array $dimensionFields
     * @return Dimension
     */
    public function fakeDimension($dimensionFields = [])
    {
        return new Dimension($this->fakeDimensionData($dimensionFields));
    }

    /**
     * Get fake data of Dimension
     *
     * @param array $dimensionFields
     * @return array
     */
    public function fakeDimensionData($dimensionFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $dimensionFields);
    }
}
