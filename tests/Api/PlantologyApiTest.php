<?php namespace Tests\Api;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakePlantologyTrait;
use Tests\ApiTestTrait;

class PlantologyApiTest extends TestCase
{
    use MakePlantologyTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_plantology()
    {
        $plantology = $this->fakePlantologyData();
        $this->response = $this->json('POST', '/api/plantologies', $plantology);

        $this->assertApiResponse($plantology);
    }

    /**
     * @test
     */
    public function test_read_plantology()
    {
        $plantology = $this->makePlantology();
        $this->response = $this->json('GET', '/api/plantologies/'.$plantology->id);

        $this->assertApiResponse($plantology->toArray());
    }

    /**
     * @test
     */
    public function test_update_plantology()
    {
        $plantology = $this->makePlantology();
        $editedPlantology = $this->fakePlantologyData();

        $this->response = $this->json('PUT', '/api/plantologies/'.$plantology->id, $editedPlantology);

        $this->assertApiResponse($editedPlantology);
    }

    /**
     * @test
     */
    public function test_delete_plantology()
    {
        $plantology = $this->makePlantology();
        $this->response = $this->json('DELETE', '/api/plantologies/'.$plantology->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/plantologies/'.$plantology->id);

        $this->response->assertStatus(404);
    }
}
