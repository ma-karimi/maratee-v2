<?php namespace Tests\Apis;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeCryoBankTrait;
use Tests\ApiTestTrait;

class CryoBankApiTest extends TestCase
{
    use MakeCryoBankTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_cryo_bank()
    {
        $cryoBank = $this->fakeCryoBankData();
        $this->response = $this->json('POST', '/api/cryoBanks', $cryoBank);

        $this->assertApiResponse($cryoBank);
    }

    /**
     * @test
     */
    public function test_read_cryo_bank()
    {
        $cryoBank = $this->makeCryoBank();
        $this->response = $this->json('GET', '/api/cryoBanks/'.$cryoBank->id);

        $this->assertApiResponse($cryoBank->toArray());
    }

    /**
     * @test
     */
    public function test_update_cryo_bank()
    {
        $cryoBank = $this->makeCryoBank();
        $editedCryoBank = $this->fakeCryoBankData();

        $this->response = $this->json('PUT', '/api/cryoBanks/'.$cryoBank->id, $editedCryoBank);

        $this->assertApiResponse($editedCryoBank);
    }

    /**
     * @test
     */
    public function test_delete_cryo_bank()
    {
        $cryoBank = $this->makeCryoBank();
        $this->response = $this->json('DELETE', '/api/cryoBanks/'.$cryoBank->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/cryoBanks/'.$cryoBank->id);

        $this->response->assertStatus(404);
    }
}
