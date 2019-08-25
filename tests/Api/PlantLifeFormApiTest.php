<?php namespace Tests\Api;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\PlantLifeForm;

class PlantLifeFormApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_plant_life_form()
    {
        $plantLifeForm = factory(PlantLifeForm::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/plant_life_forms', $plantLifeForm
        );

        $this->assertApiResponse($plantLifeForm);
    }

    /**
     * @test
     */
    public function test_read_plant_life_form()
    {
        $plantLifeForm = factory(PlantLifeForm::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/plant_life_forms/'.$plantLifeForm->id
        );

        $this->assertApiResponse($plantLifeForm->toArray());
    }

    /**
     * @test
     */
    public function test_update_plant_life_form()
    {
        $plantLifeForm = factory(PlantLifeForm::class)->create();
        $editedPlantLifeForm = factory(PlantLifeForm::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/plant_life_forms/'.$plantLifeForm->id,
            $editedPlantLifeForm
        );

        $this->assertApiResponse($editedPlantLifeForm);
    }

    /**
     * @test
     */
    public function test_delete_plant_life_form()
    {
        $plantLifeForm = factory(PlantLifeForm::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/plant_life_forms/'.$plantLifeForm->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/plant_life_forms/'.$plantLifeForm->id
        );

        $this->response->assertStatus(404);
    }
}
