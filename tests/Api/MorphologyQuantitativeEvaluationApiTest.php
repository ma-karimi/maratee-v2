<?php namespace Tests\Api;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\MorphologyQuantitativeEvaluation;

class MorphologyQuantitativeEvaluationApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_morphology_quantitative_evaluation()
    {
        $morphologyQuantitativeEvaluation = factory(MorphologyQuantitativeEvaluation::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/morphology_quantitative_evaluations', $morphologyQuantitativeEvaluation
        );

        $this->assertApiResponse($morphologyQuantitativeEvaluation);
    }

    /**
     * @test
     */
    public function test_read_morphology_quantitative_evaluation()
    {
        $morphologyQuantitativeEvaluation = factory(MorphologyQuantitativeEvaluation::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/morphology_quantitative_evaluations/'.$morphologyQuantitativeEvaluation->id
        );

        $this->assertApiResponse($morphologyQuantitativeEvaluation->toArray());
    }

    /**
     * @test
     */
    public function test_update_morphology_quantitative_evaluation()
    {
        $morphologyQuantitativeEvaluation = factory(MorphologyQuantitativeEvaluation::class)->create();
        $editedMorphologyQuantitativeEvaluation = factory(MorphologyQuantitativeEvaluation::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/morphology_quantitative_evaluations/'.$morphologyQuantitativeEvaluation->id,
            $editedMorphologyQuantitativeEvaluation
        );

        $this->assertApiResponse($editedMorphologyQuantitativeEvaluation);
    }

    /**
     * @test
     */
    public function test_delete_morphology_quantitative_evaluation()
    {
        $morphologyQuantitativeEvaluation = factory(MorphologyQuantitativeEvaluation::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/morphology_quantitative_evaluations/'.$morphologyQuantitativeEvaluation->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/morphology_quantitative_evaluations/'.$morphologyQuantitativeEvaluation->id
        );

        $this->response->assertStatus(404);
    }
}
