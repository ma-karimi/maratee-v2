<?php namespace Tests\Api;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeBioMolecularTrait;
use Tests\ApiTestTrait;

class BioMolecularApiTest extends TestCase
{
    use MakeBioMolecularTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_bio_molecular()
    {
        $bioMolecular = $this->fakeBioMolecularData();
        $this->response = $this->json('POST', '/api/bioMoleculars', $bioMolecular);

        $this->assertApiResponse($bioMolecular);
    }

    /**
     * @test
     */
    public function test_read_bio_molecular()
    {
        $bioMolecular = $this->makeBioMolecular();
        $this->response = $this->json('GET', '/api/bioMoleculars/'.$bioMolecular->id);

        $this->assertApiResponse($bioMolecular->toArray());
    }

    /**
     * @test
     */
    public function test_update_bio_molecular()
    {
        $bioMolecular = $this->makeBioMolecular();
        $editedBioMolecular = $this->fakeBioMolecularData();

        $this->response = $this->json('PUT', '/api/bioMoleculars/'.$bioMolecular->id, $editedBioMolecular);

        $this->assertApiResponse($editedBioMolecular);
    }

    /**
     * @test
     */
    public function test_delete_bio_molecular()
    {
        $bioMolecular = $this->makeBioMolecular();
        $this->response = $this->json('DELETE', '/api/bioMoleculars/'.$bioMolecular->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/bioMoleculars/'.$bioMolecular->id);

        $this->response->assertStatus(404);
    }
}
