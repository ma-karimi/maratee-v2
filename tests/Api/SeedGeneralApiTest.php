<?php namespace Tests\Api;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\SeedGeneral;

class SeedGeneralApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_seed_general()
    {
        $seedGeneral = factory(SeedGeneral::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/seed_generals', $seedGeneral
        );

        $this->assertApiResponse($seedGeneral);
    }

    /**
     * @test
     */
    public function test_read_seed_general()
    {
        $seedGeneral = factory(SeedGeneral::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/seed_generals/'.$seedGeneral->id
        );

        $this->assertApiResponse($seedGeneral->toArray());
    }

    /**
     * @test
     */
    public function test_update_seed_general()
    {
        $seedGeneral = factory(SeedGeneral::class)->create();
        $editedSeedGeneral = factory(SeedGeneral::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/seed_generals/'.$seedGeneral->id,
            $editedSeedGeneral
        );

        $this->assertApiResponse($editedSeedGeneral);
    }

    /**
     * @test
     */
    public function test_delete_seed_general()
    {
        $seedGeneral = factory(SeedGeneral::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/seed_generals/'.$seedGeneral->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/seed_generals/'.$seedGeneral->id
        );

        $this->response->assertStatus(404);
    }
}
