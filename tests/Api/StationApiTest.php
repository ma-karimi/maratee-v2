<?php namespace Tests\Api;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeStationTrait;
use Tests\ApiTestTrait;

class StationApiTest extends TestCase
{
    use MakeStationTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_station()
    {
        $station = $this->fakeStationData();
        $this->response = $this->json('POST', '/api/stations', $station);

        $this->assertApiResponse($station);
    }

    /**
     * @test
     */
    public function test_read_station()
    {
        $station = $this->makeStation();
        $this->response = $this->json('GET', '/api/stations/'.$station->id);

        $this->assertApiResponse($station->toArray());
    }

    /**
     * @test
     */
    public function test_update_station()
    {
        $station = $this->makeStation();
        $editedStation = $this->fakeStationData();

        $this->response = $this->json('PUT', '/api/stations/'.$station->id, $editedStation);

        $this->assertApiResponse($editedStation);
    }

    /**
     * @test
     */
    public function test_delete_station()
    {
        $station = $this->makeStation();
        $this->response = $this->json('DELETE', '/api/stations/'.$station->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/stations/'.$station->id);

        $this->response->assertStatus(404);
    }
}
