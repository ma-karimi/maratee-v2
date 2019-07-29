<?php namespace Tests\Apis;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeMolecularTrait;
use Tests\ApiTestTrait;

class MolecularApiTest extends TestCase
{
    use MakeMolecularTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_molecular()
    {
        $molecular = $this->fakeMolecularData();
        $this->response = $this->json('POST', '/api/moleculars', $molecular);

        $this->assertApiResponse($molecular);
    }

    /**
     * @test
     */
    public function test_read_molecular()
    {
        $molecular = $this->makeMolecular();
        $this->response = $this->json('GET', '/api/moleculars/'.$molecular->id);

        $this->assertApiResponse($molecular->toArray());
    }

    /**
     * @test
     */
    public function test_update_molecular()
    {
        $molecular = $this->makeMolecular();
        $editedMolecular = $this->fakeMolecularData();

        $this->response = $this->json('PUT', '/api/moleculars/'.$molecular->id, $editedMolecular);

        $this->assertApiResponse($editedMolecular);
    }

    /**
     * @test
     */
    public function test_delete_molecular()
    {
        $molecular = $this->makeMolecular();
        $this->response = $this->json('DELETE', '/api/moleculars/'.$molecular->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/moleculars/'.$molecular->id);

        $this->response->assertStatus(404);
    }
}
