<?php namespace Tests\Apis;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeMedicalTrait;
use Tests\ApiTestTrait;

class MedicalApiTest extends TestCase
{
    use MakeMedicalTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_medical()
    {
        $medical = $this->fakeMedicalData();
        $this->response = $this->json('POST', '/api/medicals', $medical);

        $this->assertApiResponse($medical);
    }

    /**
     * @test
     */
    public function test_read_medical()
    {
        $medical = $this->makeMedical();
        $this->response = $this->json('GET', '/api/medicals/'.$medical->id);

        $this->assertApiResponse($medical->toArray());
    }

    /**
     * @test
     */
    public function test_update_medical()
    {
        $medical = $this->makeMedical();
        $editedMedical = $this->fakeMedicalData();

        $this->response = $this->json('PUT', '/api/medicals/'.$medical->id, $editedMedical);

        $this->assertApiResponse($editedMedical);
    }

    /**
     * @test
     */
    public function test_delete_medical()
    {
        $medical = $this->makeMedical();
        $this->response = $this->json('DELETE', '/api/medicals/'.$medical->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/medicals/'.$medical->id);

        $this->response->assertStatus(404);
    }
}
