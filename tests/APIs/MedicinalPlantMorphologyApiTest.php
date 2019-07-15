<?php namespace Tests\Apis;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeMedicinalPlantMorphologyTrait;
use Tests\ApiTestTrait;

class MedicinalPlantMorphologyApiTest extends TestCase
{
    use MakeMedicinalPlantMorphologyTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_medicinal_plant_morphology()
    {
        $medicinalPlantMorphology = $this->fakeMedicinalPlantMorphologyData();
        $this->response = $this->json('POST', '/api/medicinalPlantMorphologies', $medicinalPlantMorphology);

        $this->assertApiResponse($medicinalPlantMorphology);
    }

    /**
     * @test
     */
    public function test_read_medicinal_plant_morphology()
    {
        $medicinalPlantMorphology = $this->makeMedicinalPlantMorphology();
        $this->response = $this->json('GET', '/api/medicinalPlantMorphologies/'.$medicinalPlantMorphology->id);

        $this->assertApiResponse($medicinalPlantMorphology->toArray());
    }

    /**
     * @test
     */
    public function test_update_medicinal_plant_morphology()
    {
        $medicinalPlantMorphology = $this->makeMedicinalPlantMorphology();
        $editedMedicinalPlantMorphology = $this->fakeMedicinalPlantMorphologyData();

        $this->response = $this->json('PUT', '/api/medicinalPlantMorphologies/'.$medicinalPlantMorphology->id, $editedMedicinalPlantMorphology);

        $this->assertApiResponse($editedMedicinalPlantMorphology);
    }

    /**
     * @test
     */
    public function test_delete_medicinal_plant_morphology()
    {
        $medicinalPlantMorphology = $this->makeMedicinalPlantMorphology();
        $this->response = $this->json('DELETE', '/api/medicinalPlantMorphologies/'.$medicinalPlantMorphology->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/medicinalPlantMorphologies/'.$medicinalPlantMorphology->id);

        $this->response->assertStatus(404);
    }
}
