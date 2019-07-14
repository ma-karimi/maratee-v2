<?php namespace Tests\Apis;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeMedicinalPlantConstituentTrait;
use Tests\ApiTestTrait;

class MedicinalPlantConstituentApiTest extends TestCase
{
    use MakeMedicinalPlantConstituentTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_medicinal_plant_constituent()
    {
        $medicinalPlantConstituent = $this->fakeMedicinalPlantConstituentData();
        $this->response = $this->json('POST', '/api/medicinalPlantConstituents', $medicinalPlantConstituent);

        $this->assertApiResponse($medicinalPlantConstituent);
    }

    /**
     * @test
     */
    public function test_read_medicinal_plant_constituent()
    {
        $medicinalPlantConstituent = $this->makeMedicinalPlantConstituent();
        $this->response = $this->json('GET', '/api/medicinalPlantConstituents/'.$medicinalPlantConstituent->id);

        $this->assertApiResponse($medicinalPlantConstituent->toArray());
    }

    /**
     * @test
     */
    public function test_update_medicinal_plant_constituent()
    {
        $medicinalPlantConstituent = $this->makeMedicinalPlantConstituent();
        $editedMedicinalPlantConstituent = $this->fakeMedicinalPlantConstituentData();

        $this->response = $this->json('PUT', '/api/medicinalPlantConstituents/'.$medicinalPlantConstituent->id, $editedMedicinalPlantConstituent);

        $this->assertApiResponse($editedMedicinalPlantConstituent);
    }

    /**
     * @test
     */
    public function test_delete_medicinal_plant_constituent()
    {
        $medicinalPlantConstituent = $this->makeMedicinalPlantConstituent();
        $this->response = $this->json('DELETE', '/api/medicinalPlantConstituents/'.$medicinalPlantConstituent->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/medicinalPlantConstituents/'.$medicinalPlantConstituent->id);

        $this->response->assertStatus(404);
    }
}
