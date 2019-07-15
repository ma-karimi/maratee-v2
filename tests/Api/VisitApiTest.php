<?php namespace Tests\Api;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeVisitTrait;
use Tests\ApiTestTrait;

class VisitApiTest extends TestCase
{
    use MakeVisitTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_visit()
    {
        $visit = $this->fakeVisitData();
        $this->response = $this->json('POST', '/api/visits', $visit);

        $this->assertApiResponse($visit);
    }

    /**
     * @test
     */
    public function test_read_visit()
    {
        $visit = $this->makeVisit();
        $this->response = $this->json('GET', '/api/visits/'.$visit->id);

        $this->assertApiResponse($visit->toArray());
    }

    /**
     * @test
     */
    public function test_update_visit()
    {
        $visit = $this->makeVisit();
        $editedVisit = $this->fakeVisitData();

        $this->response = $this->json('PUT', '/api/visits/'.$visit->id, $editedVisit);

        $this->assertApiResponse($editedVisit);
    }

    /**
     * @test
     */
    public function test_delete_visit()
    {
        $visit = $this->makeVisit();
        $this->response = $this->json('DELETE', '/api/visits/'.$visit->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/visits/'.$visit->id);

        $this->response->assertStatus(404);
    }
}
