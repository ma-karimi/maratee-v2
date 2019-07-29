<?php namespace Tests\Apis;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeCryoBankActionTrait;
use Tests\ApiTestTrait;

class CryoBankActionApiTest extends TestCase
{
    use MakeCryoBankActionTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_cryo_bank_action()
    {
        $cryoBankAction = $this->fakeCryoBankActionData();
        $this->response = $this->json('POST', '/api/cryoBankActions', $cryoBankAction);

        $this->assertApiResponse($cryoBankAction);
    }

    /**
     * @test
     */
    public function test_read_cryo_bank_action()
    {
        $cryoBankAction = $this->makeCryoBankAction();
        $this->response = $this->json('GET', '/api/cryoBankActions/'.$cryoBankAction->id);

        $this->assertApiResponse($cryoBankAction->toArray());
    }

    /**
     * @test
     */
    public function test_update_cryo_bank_action()
    {
        $cryoBankAction = $this->makeCryoBankAction();
        $editedCryoBankAction = $this->fakeCryoBankActionData();

        $this->response = $this->json('PUT', '/api/cryoBankActions/'.$cryoBankAction->id, $editedCryoBankAction);

        $this->assertApiResponse($editedCryoBankAction);
    }

    /**
     * @test
     */
    public function test_delete_cryo_bank_action()
    {
        $cryoBankAction = $this->makeCryoBankAction();
        $this->response = $this->json('DELETE', '/api/cryoBankActions/'.$cryoBankAction->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/cryoBankActions/'.$cryoBankAction->id);

        $this->response->assertStatus(404);
    }
}
