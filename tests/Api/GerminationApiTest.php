<?php namespace Tests\Api;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeGerminationTrait;
use Tests\ApiTestTrait;

class GerminationApiTest extends TestCase
{
    use MakeGerminationTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_germination()
    {
        $germination = $this->fakeGerminationData();
        $this->response = $this->json('POST', '/api/germinations', $germination);

        $this->assertApiResponse($germination);
    }

    /**
     * @test
     */
    public function test_read_germination()
    {
        $germination = $this->makeGermination();
        $this->response = $this->json('GET', '/api/germinations/'.$germination->id);

        $this->assertApiResponse($germination->toArray());
    }

    /**
     * @test
     */
    public function test_update_germination()
    {
        $germination = $this->makeGermination();
        $editedGermination = $this->fakeGerminationData();

        $this->response = $this->json('PUT', '/api/germinations/'.$germination->id, $editedGermination);

        $this->assertApiResponse($editedGermination);
    }

    /**
     * @test
     */
    public function test_delete_germination()
    {
        $germination = $this->makeGermination();
        $this->response = $this->json('DELETE', '/api/germinations/'.$germination->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/germinations/'.$germination->id);

        $this->response->assertStatus(404);
    }
}
