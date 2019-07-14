<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Morphology;
use App\Repositories\MorphologyRepository;

trait MakeMorphologyTrait
{
    /**
     * Create fake instance of Morphology and save it in database
     *
     * @param array $morphologyFields
     * @return Morphology
     */
    public function makeMorphology($morphologyFields = [])
    {
        /** @var MorphologyRepository $morphologyRepo */
        $morphologyRepo = \App::make(MorphologyRepository::class);
        $theme = $this->fakeMorphologyData($morphologyFields);
        return $morphologyRepo->create($theme);
    }

    /**
     * Get fake instance of Morphology
     *
     * @param array $morphologyFields
     * @return Morphology
     */
    public function fakeMorphology($morphologyFields = [])
    {
        return new Morphology($this->fakeMorphologyData($morphologyFields));
    }

    /**
     * Get fake data of Morphology
     *
     * @param array $morphologyFields
     * @return array
     */
    public function fakeMorphologyData($morphologyFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $morphologyFields);
    }
}
