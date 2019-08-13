<?php namespace Tests\Api;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeClassificationTrait;
use Tests\ApiTestTrait;

class ClassificationApiTest extends TestCase
{
    use MakeClassificationTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_classification()
    {
        $classification = $this->fakeClassificationData();
        $this->response = $this->json('POST', '/api/classifications', $classification);

        $this->assertApiResponse($classification);
    }

    /**
     * @test
     */
    public function test_read_classification()
    {
        $classification = $this->makeClassification();
        $this->response = $this->json('GET', '/api/classifications/'.$classification->id);

        $this->assertApiResponse($classification->toArray());
    }

    /**
     * @test
     */
    public function test_update_classification()
    {
        $classification = $this->makeClassification();
        $editedClassification = $this->fakeClassificationData();

        $this->response = $this->json('PUT', '/api/classifications/'.$classification->id, $editedClassification);

        $this->assertApiResponse($editedClassification);
    }

    /**
     * @test
     */
    public function test_delete_classification()
    {
        $classification = $this->makeClassification();
        $this->response = $this->json('DELETE', '/api/classifications/'.$classification->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/classifications/'.$classification->id);

        $this->response->assertStatus(404);
    }
}
