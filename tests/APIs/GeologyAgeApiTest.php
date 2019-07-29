<?php namespace Tests\Apis;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeGeologyAgeTrait;
use Tests\ApiTestTrait;

class GeologyAgeApiTest extends TestCase
{
    use MakeGeologyAgeTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_geology_age()
    {
        $geologyAge = $this->fakeGeologyAgeData();
        $this->response = $this->json('POST', '/api/geologyAges', $geologyAge);

        $this->assertApiResponse($geologyAge);
    }

    /**
     * @test
     */
    public function test_read_geology_age()
    {
        $geologyAge = $this->makeGeologyAge();
        $this->response = $this->json('GET', '/api/geologyAges/'.$geologyAge->id);

        $this->assertApiResponse($geologyAge->toArray());
    }

    /**
     * @test
     */
    public function test_update_geology_age()
    {
        $geologyAge = $this->makeGeologyAge();
        $editedGeologyAge = $this->fakeGeologyAgeData();

        $this->response = $this->json('PUT', '/api/geologyAges/'.$geologyAge->id, $editedGeologyAge);

        $this->assertApiResponse($editedGeologyAge);
    }

    /**
     * @test
     */
    public function test_delete_geology_age()
    {
        $geologyAge = $this->makeGeologyAge();
        $this->response = $this->json('DELETE', '/api/geologyAges/'.$geologyAge->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/geologyAges/'.$geologyAge->id);

        $this->response->assertStatus(404);
    }
}
