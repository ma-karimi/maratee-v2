<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Plantology;
use App\Repositories\PlantologyRepository;

trait MakePlantologyTrait
{
    /**
     * Create fake instance of Plantology and save it in database
     *
     * @param array $plantologyFields
     * @return Plantology
     */
    public function makePlantology($plantologyFields = [])
    {
        /** @var PlantologyRepository $plantologyRepo */
        $plantologyRepo = \App::make(PlantologyRepository::class);
        $theme = $this->fakePlantologyData($plantologyFields);
        return $plantologyRepo->create($theme);
    }

    /**
     * Get fake instance of Plantology
     *
     * @param array $plantologyFields
     * @return Plantology
     */
    public function fakePlantology($plantologyFields = [])
    {
        return new Plantology($this->fakePlantologyData($plantologyFields));
    }

    /**
     * Get fake data of Plantology
     *
     * @param array $plantologyFields
     * @return array
     */
    public function fakePlantologyData($plantologyFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $plantologyFields);
    }
}
