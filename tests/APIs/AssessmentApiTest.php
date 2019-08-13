<?php namespace Tests\Apis;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeevaluationTrait;
use Tests\ApiTestTrait;

class evaluationApiTest extends TestCase
{
    use MakeevaluationTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_evaluation()
    {
        $evaluation = $this->fakeevaluationData();
        $this->response = $this->json('POST', '/api/evaluations', $evaluation);

        $this->assertApiResponse($evaluation);
    }

    /**
     * @test
     */
    public function test_read_evaluation()
    {
        $evaluation = $this->makeevaluation();
        $this->response = $this->json('GET', '/api/evaluations/'.$evaluation->id);

        $this->assertApiResponse($evaluation->toArray());
    }

    /**
     * @test
     */
    public function test_update_evaluation()
    {
        $evaluation = $this->makeevaluation();
        $editedevaluation = $this->fakeevaluationData();

        $this->response = $this->json('PUT', '/api/evaluations/'.$evaluation->id, $editedevaluation);

        $this->assertApiResponse($editedevaluation);
    }

    /**
     * @test
     */
    public function test_delete_evaluation()
    {
        $evaluation = $this->makeevaluation();
        $this->response = $this->json('DELETE', '/api/evaluations/'.$evaluation->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/evaluations/'.$evaluation->id);

        $this->response->assertStatus(404);
    }
}
