<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\EvaluationDimension;
use App\Repositories\EvaluationDimensionRepository;

trait MakeEvaluationDimensionTrait
{
    /**
     * Create fake instance of EvaluationDimension and save it in database
     *
     * @param array $evaluationDimensionFields
     * @return EvaluationDimension
     */
    public function makeEvaluationDimension($evaluationDimensionFields = [])
    {
        /** @var EvaluationDimensionRepository $evaluationDimensionRepo */
        $evaluationDimensionRepo = \App::make(EvaluationDimensionRepository::class);
        $theme = $this->fakeEvaluationDimensionData($evaluationDimensionFields);
        return $evaluationDimensionRepo->create($theme);
    }

    /**
     * Get fake instance of EvaluationDimension
     *
     * @param array $evaluationDimensionFields
     * @return EvaluationDimension
     */
    public function fakeEvaluationDimension($evaluationDimensionFields = [])
    {
        return new EvaluationDimension($this->fakeEvaluationDimensionData($evaluationDimensionFields));
    }

    /**
     * Get fake data of EvaluationDimension
     *
     * @param array $evaluationDimensionFields
     * @return array
     */
    public function fakeEvaluationDimensionData($evaluationDimensionFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $evaluationDimensionFields);
    }
}
