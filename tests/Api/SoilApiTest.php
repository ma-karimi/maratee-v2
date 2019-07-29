<?php namespace Tests\Api;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeSoilTrait;
use Tests\ApiTestTrait;

class SoilApiTest extends TestCase
{
    use MakeSoilTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_soil()
    {
        $soil = $this->fakeSoilData();
        $this->response = $this->json('POST', '/api/soils', $soil);

        $this->assertApiResponse($soil);
    }

    /**
     * @test
     */
    public function test_read_soil()
    {
        $soil = $this->makeSoil();
        $this->response = $this->json('GET', '/api/soils/'.$soil->id);

        $this->assertApiResponse($soil->toArray());
    }

    /**
     * @test
     */
    public function test_update_soil()
    {
        $soil = $this->makeSoil();
        $editedSoil = $this->fakeSoilData();

        $this->response = $this->json('PUT', '/api/soils/'.$soil->id, $editedSoil);

        $this->assertApiResponse($editedSoil);
    }

    /**
     * @test
     */
    public function test_delete_soil()
    {
        $soil = $this->makeSoil();
        $this->response = $this->json('DELETE', '/api/soils/'.$soil->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/soils/'.$soil->id);

        $this->response->assertStatus(404);
    }
}
