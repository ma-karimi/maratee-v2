<?php namespace Tests\Apis;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeLightingTrait;
use Tests\ApiTestTrait;

class LightingApiTest extends TestCase
{
    use MakeLightingTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_lighting()
    {
        $lighting = $this->fakeLightingData();
        $this->response = $this->json('POST', '/api/lightings', $lighting);

        $this->assertApiResponse($lighting);
    }

    /**
     * @test
     */
    public function test_read_lighting()
    {
        $lighting = $this->makeLighting();
        $this->response = $this->json('GET', '/api/lightings/'.$lighting->id);

        $this->assertApiResponse($lighting->toArray());
    }

    /**
     * @test
     */
    public function test_update_lighting()
    {
        $lighting = $this->makeLighting();
        $editedLighting = $this->fakeLightingData();

        $this->response = $this->json('PUT', '/api/lightings/'.$lighting->id, $editedLighting);

        $this->assertApiResponse($editedLighting);
    }

    /**
     * @test
     */
    public function test_delete_lighting()
    {
        $lighting = $this->makeLighting();
        $this->response = $this->json('DELETE', '/api/lightings/'.$lighting->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/lightings/'.$lighting->id);

        $this->response->assertStatus(404);
    }
}
