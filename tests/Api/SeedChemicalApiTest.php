<?php namespace Tests\Api;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeSeedChemicalTrait;
use Tests\ApiTestTrait;

class SeedChemicalApiTest extends TestCase
{
    use MakeSeedChemicalTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_seed_chemical()
    {
        $seedChemical = $this->fakeSeedChemicalData();
        $this->response = $this->json('POST', '/api/seedChemicals', $seedChemical);

        $this->assertApiResponse($seedChemical);
    }

    /**
     * @test
     */
    public function test_read_seed_chemical()
    {
        $seedChemical = $this->makeSeedChemical();
        $this->response = $this->json('GET', '/api/seedChemicals/'.$seedChemical->id);

        $this->assertApiResponse($seedChemical->toArray());
    }

    /**
     * @test
     */
    public function test_update_seed_chemical()
    {
        $seedChemical = $this->makeSeedChemical();
        $editedSeedChemical = $this->fakeSeedChemicalData();

        $this->response = $this->json('PUT', '/api/seedChemicals/'.$seedChemical->id, $editedSeedChemical);

        $this->assertApiResponse($editedSeedChemical);
    }

    /**
     * @test
     */
    public function test_delete_seed_chemical()
    {
        $seedChemical = $this->makeSeedChemical();
        $this->response = $this->json('DELETE', '/api/seedChemicals/'.$seedChemical->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/seedChemicals/'.$seedChemical->id);

        $this->response->assertStatus(404);
    }
}
