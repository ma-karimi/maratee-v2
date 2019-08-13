<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\evaluationCollection;
use App\Repositories\evaluationCollectionRepository;

trait MakeevaluationCollectionTrait
{
    /**
     * Create fake instance of evaluationCollection and save it in database
     *
     * @param array $evaluationCollectionFields
     * @return evaluationCollection
     */
    public function makeevaluationCollection($evaluationCollectionFields = [])
    {
        /** @var evaluationCollectionRepository $evaluationCollectionRepo */
        $evaluationCollectionRepo = \App::make(evaluationCollectionRepository::class);
        $theme = $this->fakeevaluationCollectionData($evaluationCollectionFields);
        return $evaluationCollectionRepo->create($theme);
    }

    /**
     * Get fake instance of evaluationCollection
     *
     * @param array $evaluationCollectionFields
     * @return evaluationCollection
     */
    public function fakeevaluationCollection($evaluationCollectionFields = [])
    {
        return new evaluationCollection($this->fakeevaluationCollectionData($evaluationCollectionFields));
    }

    /**
     * Get fake data of evaluationCollection
     *
     * @param array $evaluationCollectionFields
     * @return array
     */
    public function fakeevaluationCollectionData($evaluationCollectionFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $evaluationCollectionFields);
    }
}
