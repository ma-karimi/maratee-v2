<?php namespace Tests\Api;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeGeneralTrait;
use Tests\ApiTestTrait;

class GeneralApiTest extends TestCase
{
    use MakeGeneralTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_general()
    {
        $general = $this->fakeGeneralData();
        $this->response = $this->json('POST', '/api/generals', $general);

        $this->assertApiResponse($general);
    }

    /**
     * @test
     */
    public function test_read_general()
    {
        $general = $this->makeGeneral();
        $this->response = $this->json('GET', '/api/generals/'.$general->id);

        $this->assertApiResponse($general->toArray());
    }

    /**
     * @test
     */
    public function test_update_general()
    {
        $general = $this->makeGeneral();
        $editedGeneral = $this->fakeGeneralData();

        $this->response = $this->json('PUT', '/api/generals/'.$general->id, $editedGeneral);

        $this->assertApiResponse($editedGeneral);
    }

    /**
     * @test
     */
    public function test_delete_general()
    {
        $general = $this->makeGeneral();
        $this->response = $this->json('DELETE', '/api/generals/'.$general->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/generals/'.$general->id);

        $this->response->assertStatus(404);
    }
}
