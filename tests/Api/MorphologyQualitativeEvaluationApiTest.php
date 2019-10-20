<?php namespace Tests\Api;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\MorphologyQualitativeEvaluation;

class MorphologyQualitativeEvaluationApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_morphology_qualitative_evaluation()
    {
        $morphologyQualitativeEvaluation = factory(MorphologyQualitativeEvaluation::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/morphology_qualitative_evaluations', $morphologyQualitativeEvaluation
        );

        $this->assertApiResponse($morphologyQualitativeEvaluation);
    }

    /**
     * @test
     */
    public function test_read_morphology_qualitative_evaluation()
    {
        $morphologyQualitativeEvaluation = factory(MorphologyQualitativeEvaluation::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/morphology_qualitative_evaluations/'.$morphologyQualitativeEvaluation->id
        );

        $this->assertApiResponse($morphologyQualitativeEvaluation->toArray());
    }

    /**
     * @test
     */
    public function test_update_morphology_qualitative_evaluation()
    {
        $morphologyQualitativeEvaluation = factory(MorphologyQualitativeEvaluation::class)->create();
        $editedMorphologyQualitativeEvaluation = factory(MorphologyQualitativeEvaluation::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/morphology_qualitative_evaluations/'.$morphologyQualitativeEvaluation->id,
            $editedMorphologyQualitativeEvaluation
        );

        $this->assertApiResponse($editedMorphologyQualitativeEvaluation);
    }

    /**
     * @test
     */
    public function test_delete_morphology_qualitative_evaluation()
    {
        $morphologyQualitativeEvaluation = factory(MorphologyQualitativeEvaluation::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/morphology_qualitative_evaluations/'.$morphologyQualitativeEvaluation->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/morphology_qualitative_evaluations/'.$morphologyQualitativeEvaluation->id
        );

        $this->response->assertStatus(404);
    }
}
