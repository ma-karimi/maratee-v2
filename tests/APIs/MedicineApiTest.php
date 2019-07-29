<?php namespace Tests\Apis;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeMedicineTrait;
use Tests\ApiTestTrait;

class MedicineApiTest extends TestCase
{
    use MakeMedicineTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_medicine()
    {
        $medicine = $this->fakeMedicineData();
        $this->response = $this->json('POST', '/api/medicines', $medicine);

        $this->assertApiResponse($medicine);
    }

    /**
     * @test
     */
    public function test_read_medicine()
    {
        $medicine = $this->makeMedicine();
        $this->response = $this->json('GET', '/api/medicines/'.$medicine->id);

        $this->assertApiResponse($medicine->toArray());
    }

    /**
     * @test
     */
    public function test_update_medicine()
    {
        $medicine = $this->makeMedicine();
        $editedMedicine = $this->fakeMedicineData();

        $this->response = $this->json('PUT', '/api/medicines/'.$medicine->id, $editedMedicine);

        $this->assertApiResponse($editedMedicine);
    }

    /**
     * @test
     */
    public function test_delete_medicine()
    {
        $medicine = $this->makeMedicine();
        $this->response = $this->json('DELETE', '/api/medicines/'.$medicine->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/medicines/'.$medicine->id);

        $this->response->assertStatus(404);
    }
}
