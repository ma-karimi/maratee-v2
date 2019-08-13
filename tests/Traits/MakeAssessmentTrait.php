<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\evaluation;
use App\Repositories\evaluationRepository;

trait MakeevaluationTrait
{
    /**
     * Create fake instance of evaluation and save it in database
     *
     * @param array $evaluationFields
     * @return evaluation
     */
    public function makeevaluation($evaluationFields = [])
    {
        /** @var evaluationRepository $evaluationRepo */
        $evaluationRepo = \App::make(evaluationRepository::class);
        $theme = $this->fakeevaluationData($evaluationFields);
        return $evaluationRepo->create($theme);
    }

    /**
     * Get fake instance of evaluation
     *
     * @param array $evaluationFields
     * @return evaluation
     */
    public function fakeevaluation($evaluationFields = [])
    {
        return new evaluation($this->fakeevaluationData($evaluationFields));
    }

    /**
     * Get fake data of evaluation
     *
     * @param array $evaluationFields
     * @return array
     */
    public function fakeevaluationData($evaluationFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $evaluationFields);
    }
}
