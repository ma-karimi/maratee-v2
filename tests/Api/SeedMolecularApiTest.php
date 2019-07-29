<?php namespace Tests\Api;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeSeedMolecularTrait;
use Tests\ApiTestTrait;

class SeedMolecularApiTest extends TestCase
{
    use MakeSeedMolecularTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_seed_molecular()
    {
        $seedMolecular = $this->fakeSeedMolecularData();
        $this->response = $this->json('POST', '/api/seedMoleculars', $seedMolecular);

        $this->assertApiResponse($seedMolecular);
    }

    /**
     * @test
     */
    public function test_read_seed_molecular()
    {
        $seedMolecular = $this->makeSeedMolecular();
        $this->response = $this->json('GET', '/api/seedMoleculars/'.$seedMolecular->id);

        $this->assertApiResponse($seedMolecular->toArray());
    }

    /**
     * @test
     */
    public function test_update_seed_molecular()
    {
        $seedMolecular = $this->makeSeedMolecular();
        $editedSeedMolecular = $this->fakeSeedMolecularData();

        $this->response = $this->json('PUT', '/api/seedMoleculars/'.$seedMolecular->id, $editedSeedMolecular);

        $this->assertApiResponse($editedSeedMolecular);
    }

    /**
     * @test
     */
    public function test_delete_seed_molecular()
    {
        $seedMolecular = $this->makeSeedMolecular();
        $this->response = $this->json('DELETE', '/api/seedMoleculars/'.$seedMolecular->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/seedMoleculars/'.$seedMolecular->id);

        $this->response->assertStatus(404);
    }
}
