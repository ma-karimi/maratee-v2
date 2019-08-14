<?php namespace Tests\Api;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeEvaluationDimensionTrait;
use Tests\ApiTestTrait;

class EvaluationDimensionApiTest extends TestCase
{
    use MakeEvaluationDimensionTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_evaluation_dimension()
    {
        $evaluationDimension = $this->fakeEvaluationDimensionData();
        $this->response = $this->json('POST', '/api/evaluationDimensions', $evaluationDimension);

        $this->assertApiResponse($evaluationDimension);
    }

    /**
     * @test
     */
    public function test_read_evaluation_dimension()
    {
        $evaluationDimension = $this->makeEvaluationDimension();
        $this->response = $this->json('GET', '/api/evaluationDimensions/'.$evaluationDimension->id);

        $this->assertApiResponse($evaluationDimension->toArray());
    }

    /**
     * @test
     */
    public function test_update_evaluation_dimension()
    {
        $evaluationDimension = $this->makeEvaluationDimension();
        $editedEvaluationDimension = $this->fakeEvaluationDimensionData();

        $this->response = $this->json('PUT', '/api/evaluationDimensions/'.$evaluationDimension->id, $editedEvaluationDimension);

        $this->assertApiResponse($editedEvaluationDimension);
    }

    /**
     * @test
     */
    public function test_delete_evaluation_dimension()
    {
        $evaluationDimension = $this->makeEvaluationDimension();
        $this->response = $this->json('DELETE', '/api/evaluationDimensions/'.$evaluationDimension->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/evaluationDimensions/'.$evaluationDimension->id);

        $this->response->assertStatus(404);
    }
}
