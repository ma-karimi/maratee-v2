<?php namespace Tests\Api;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeSeedPlantTrait;
use Tests\ApiTestTrait;

class SeedPlantApiTest extends TestCase
{
    use MakeSeedPlantTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_seed_plant()
    {
        $seedPlant = $this->fakeSeedPlantData();
        $this->response = $this->json('POST', '/api/seedPlants', $seedPlant);

        $this->assertApiResponse($seedPlant);
    }

    /**
     * @test
     */
    public function test_read_seed_plant()
    {
        $seedPlant = $this->makeSeedPlant();
        $this->response = $this->json('GET', '/api/seedPlants/'.$seedPlant->id);

        $this->assertApiResponse($seedPlant->toArray());
    }

    /**
     * @test
     */
    public function test_update_seed_plant()
    {
        $seedPlant = $this->makeSeedPlant();
        $editedSeedPlant = $this->fakeSeedPlantData();

        $this->response = $this->json('PUT', '/api/seedPlants/'.$seedPlant->id, $editedSeedPlant);

        $this->assertApiResponse($editedSeedPlant);
    }

    /**
     * @test
     */
    public function test_delete_seed_plant()
    {
        $seedPlant = $this->makeSeedPlant();
        $this->response = $this->json('DELETE', '/api/seedPlants/'.$seedPlant->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/seedPlants/'.$seedPlant->id);

        $this->response->assertStatus(404);
    }
}
