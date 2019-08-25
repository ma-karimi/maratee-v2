<?php namespace Tests\Api;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\LifeForm;

class LifeFormApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_life_form()
    {
        $lifeForm = factory(LifeForm::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/life_forms', $lifeForm
        );

        $this->assertApiResponse($lifeForm);
    }

    /**
     * @test
     */
    public function test_read_life_form()
    {
        $lifeForm = factory(LifeForm::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/life_forms/'.$lifeForm->id
        );

        $this->assertApiResponse($lifeForm->toArray());
    }

    /**
     * @test
     */
    public function test_update_life_form()
    {
        $lifeForm = factory(LifeForm::class)->create();
        $editedLifeForm = factory(LifeForm::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/life_forms/'.$lifeForm->id,
            $editedLifeForm
        );

        $this->assertApiResponse($editedLifeForm);
    }

    /**
     * @test
     */
    public function test_delete_life_form()
    {
        $lifeForm = factory(LifeForm::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/life_forms/'.$lifeForm->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/life_forms/'.$lifeForm->id
        );

        $this->response->assertStatus(404);
    }
}
