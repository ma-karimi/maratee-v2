<?php namespace Tests\Apis;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeMedicinalPlantTrait;
use Tests\ApiTestTrait;

class MedicinalPlantApiTest extends TestCase
{
    use MakeMedicinalPlantTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_medicinal_plant()
    {
        $medicinalPlant = $this->fakeMedicinalPlantData();
        $this->response = $this->json('POST', '/api/medicinalPlants', $medicinalPlant);

        $this->assertApiResponse($medicinalPlant);
    }

    /**
     * @test
     */
    public function test_read_medicinal_plant()
    {
        $medicinalPlant = $this->makeMedicinalPlant();
        $this->response = $this->json('GET', '/api/medicinalPlants/'.$medicinalPlant->id);

        $this->assertApiResponse($medicinalPlant->toArray());
    }

    /**
     * @test
     */
    public function test_update_medicinal_plant()
    {
        $medicinalPlant = $this->makeMedicinalPlant();
        $editedMedicinalPlant = $this->fakeMedicinalPlantData();

        $this->response = $this->json('PUT', '/api/medicinalPlants/'.$medicinalPlant->id, $editedMedicinalPlant);

        $this->assertApiResponse($editedMedicinalPlant);
    }

    /**
     * @test
     */
    public function test_delete_medicinal_plant()
    {
        $medicinalPlant = $this->makeMedicinalPlant();
        $this->response = $this->json('DELETE', '/api/medicinalPlants/'.$medicinalPlant->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/medicinalPlants/'.$medicinalPlant->id);

        $this->response->assertStatus(404);
    }
}
