<?php namespace Tests\Api;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeReproductionTrait;
use Tests\ApiTestTrait;

class ReproductionApiTest extends TestCase
{
    use MakeReproductionTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_reproduction()
    {
        $reproduction = $this->fakeReproductionData();
        $this->response = $this->json('POST', '/api/reproductions', $reproduction);

        $this->assertApiResponse($reproduction);
    }

    /**
     * @test
     */
    public function test_read_reproduction()
    {
        $reproduction = $this->makeReproduction();
        $this->response = $this->json('GET', '/api/reproductions/'.$reproduction->id);

        $this->assertApiResponse($reproduction->toArray());
    }

    /**
     * @test
     */
    public function test_update_reproduction()
    {
        $reproduction = $this->makeReproduction();
        $editedReproduction = $this->fakeReproductionData();

        $this->response = $this->json('PUT', '/api/reproductions/'.$reproduction->id, $editedReproduction);

        $this->assertApiResponse($editedReproduction);
    }

    /**
     * @test
     */
    public function test_delete_reproduction()
    {
        $reproduction = $this->makeReproduction();
        $this->response = $this->json('DELETE', '/api/reproductions/'.$reproduction->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/reproductions/'.$reproduction->id);

        $this->response->assertStatus(404);
    }
}
