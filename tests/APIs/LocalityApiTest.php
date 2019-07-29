<?php namespace Tests\Apis;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeLocalityTrait;
use Tests\ApiTestTrait;

class LocalityApiTest extends TestCase
{
    use MakeLocalityTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_locality()
    {
        $locality = $this->fakeLocalityData();
        $this->response = $this->json('POST', '/api/localities', $locality);

        $this->assertApiResponse($locality);
    }

    /**
     * @test
     */
    public function test_read_locality()
    {
        $locality = $this->makeLocality();
        $this->response = $this->json('GET', '/api/localities/'.$locality->id);

        $this->assertApiResponse($locality->toArray());
    }

    /**
     * @test
     */
    public function test_update_locality()
    {
        $locality = $this->makeLocality();
        $editedLocality = $this->fakeLocalityData();

        $this->response = $this->json('PUT', '/api/localities/'.$locality->id, $editedLocality);

        $this->assertApiResponse($editedLocality);
    }

    /**
     * @test
     */
    public function test_delete_locality()
    {
        $locality = $this->makeLocality();
        $this->response = $this->json('DELETE', '/api/localities/'.$locality->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/localities/'.$locality->id);

        $this->response->assertStatus(404);
    }
}
