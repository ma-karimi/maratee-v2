<?php namespace Tests\Api;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\MedicinalPlantType;

class MedicinalPlantTypeApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_medicinal_plant_type()
    {
        $medicinalPlantType = factory(MedicinalPlantType::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/medicinal_plant_types', $medicinalPlantType
        );

        $this->assertApiResponse($medicinalPlantType);
    }

    /**
     * @test
     */
    public function test_read_medicinal_plant_type()
    {
        $medicinalPlantType = factory(MedicinalPlantType::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/medicinal_plant_types/'.$medicinalPlantType->id
        );

        $this->assertApiResponse($medicinalPlantType->toArray());
    }

    /**
     * @test
     */
    public function test_update_medicinal_plant_type()
    {
        $medicinalPlantType = factory(MedicinalPlantType::class)->create();
        $editedMedicinalPlantType = factory(MedicinalPlantType::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/medicinal_plant_types/'.$medicinalPlantType->id,
            $editedMedicinalPlantType
        );

        $this->assertApiResponse($editedMedicinalPlantType);
    }

    /**
     * @test
     */
    public function test_delete_medicinal_plant_type()
    {
        $medicinalPlantType = factory(MedicinalPlantType::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/medicinal_plant_types/'.$medicinalPlantType->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/medicinal_plant_types/'.$medicinalPlantType->id
        );

        $this->response->assertStatus(404);
    }
}
