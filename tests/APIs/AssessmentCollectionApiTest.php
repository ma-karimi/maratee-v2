<?php namespace Tests\Apis;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeevaluationCollectionTrait;
use Tests\ApiTestTrait;

class evaluationCollectionApiTest extends TestCase
{
    use MakeevaluationCollectionTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_evaluation_collection()
    {
        $evaluationCollection = $this->fakeevaluationCollectionData();
        $this->response = $this->json('POST', '/api/evaluationCollections', $evaluationCollection);

        $this->assertApiResponse($evaluationCollection);
    }

    /**
     * @test
     */
    public function test_read_evaluation_collection()
    {
        $evaluationCollection = $this->makeevaluationCollection();
        $this->response = $this->json('GET', '/api/evaluationCollections/'.$evaluationCollection->id);

        $this->assertApiResponse($evaluationCollection->toArray());
    }

    /**
     * @test
     */
    public function test_update_evaluation_collection()
    {
        $evaluationCollection = $this->makeevaluationCollection();
        $editedevaluationCollection = $this->fakeevaluationCollectionData();

        $this->response = $this->json('PUT', '/api/evaluationCollections/'.$evaluationCollection->id, $editedevaluationCollection);

        $this->assertApiResponse($editedevaluationCollection);
    }

    /**
     * @test
     */
    public function test_delete_evaluation_collection()
    {
        $evaluationCollection = $this->makeevaluationCollection();
        $this->response = $this->json('DELETE', '/api/evaluationCollections/'.$evaluationCollection->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/evaluationCollections/'.$evaluationCollection->id);

        $this->response->assertStatus(404);
    }
}
