<?php namespace Tests\Api;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakePropagationTrait;
use Tests\ApiTestTrait;

class PropagationApiTest extends TestCase
{
    use MakePropagationTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_propagation()
    {
        $propagation = $this->fakePropagationData();
        $this->response = $this->json('POST', '/api/propagations', $propagation);

        $this->assertApiResponse($propagation);
    }

    /**
     * @test
     */
    public function test_read_propagation()
    {
        $reproduction = $this->makePropagation();
        $this->response = $this->json('GET', '/api/reproductions/'.$reproduction->id);

        $this->assertApiResponse($reproduction->toArray());
    }

    /**
     * @test
     */
    public function test_update_reproduction()
    {
        $reproduction = $this->makePropagation();
        $editedPropagation = $this->fakePropagationData();

        $this->response = $this->json('PUT', '/api/reproductions/'.$reproduction->id, $editedPropagation);

        $this->assertApiResponse($editedPropagation);
    }

    /**
     * @test
     */
    public function test_delete_reproduction()
    {
        $reproduction = $this->makePropagation();
        $this->response = $this->json('DELETE', '/api/reproductions/'.$reproduction->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/reproductions/'.$reproduction->id);

        $this->response->assertStatus(404);
    }
}
