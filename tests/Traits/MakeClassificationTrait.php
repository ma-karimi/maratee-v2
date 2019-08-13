<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Classification;
use App\Repositories\ClassificationRepository;

trait MakeClassificationTrait
{
    /**
     * Create fake instance of Classification and save it in database
     *
     * @param array $classificationFields
     * @return Classification
     */
    public function makeClassification($classificationFields = [])
    {
        /** @var ClassificationRepository $classificationRepo */
        $classificationRepo = \App::make(ClassificationRepository::class);
        $theme = $this->fakeClassificationData($classificationFields);
        return $classificationRepo->create($theme);
    }

    /**
     * Get fake instance of Classification
     *
     * @param array $classificationFields
     * @return Classification
     */
    public function fakeClassification($classificationFields = [])
    {
        return new Classification($this->fakeClassificationData($classificationFields));
    }

    /**
     * Get fake data of Classification
     *
     * @param array $classificationFields
     * @return array
     */
    public function fakeClassificationData($classificationFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $classificationFields);
    }
}
