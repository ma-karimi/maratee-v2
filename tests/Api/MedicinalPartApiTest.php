<?php namespace Tests\Api;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\MedicinalPart;

class MedicinalPartApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_medicinal_part()
    {
        $medicinalPart = factory(MedicinalPart::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/medicinal_parts', $medicinalPart
        );

        $this->assertApiResponse($medicinalPart);
    }

    /**
     * @test
     */
    public function test_read_medicinal_part()
    {
        $medicinalPart = factory(MedicinalPart::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/medicinal_parts/'.$medicinalPart->id
        );

        $this->assertApiResponse($medicinalPart->toArray());
    }

    /**
     * @test
     */
    public function test_update_medicinal_part()
    {
        $medicinalPart = factory(MedicinalPart::class)->create();
        $editedMedicinalPart = factory(MedicinalPart::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/medicinal_parts/'.$medicinalPart->id,
            $editedMedicinalPart
        );

        $this->assertApiResponse($editedMedicinalPart);
    }

    /**
     * @test
     */
    public function test_delete_medicinal_part()
    {
        $medicinalPart = factory(MedicinalPart::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/medicinal_parts/'.$medicinalPart->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/medicinal_parts/'.$medicinalPart->id
        );

        $this->response->assertStatus(404);
    }
}
