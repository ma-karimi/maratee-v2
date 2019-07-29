<?php namespace Tests\Api;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeProtectionTrait;
use Tests\ApiTestTrait;

class ProtectionApiTest extends TestCase
{
    use MakeProtectionTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_protection()
    {
        $protection = $this->fakeProtectionData();
        $this->response = $this->json('POST', '/api/protections', $protection);

        $this->assertApiResponse($protection);
    }

    /**
     * @test
     */
    public function test_read_protection()
    {
        $protection = $this->makeProtection();
        $this->response = $this->json('GET', '/api/protections/'.$protection->id);

        $this->assertApiResponse($protection->toArray());
    }

    /**
     * @test
     */
    public function test_update_protection()
    {
        $protection = $this->makeProtection();
        $editedProtection = $this->fakeProtectionData();

        $this->response = $this->json('PUT', '/api/protections/'.$protection->id, $editedProtection);

        $this->assertApiResponse($editedProtection);
    }

    /**
     * @test
     */
    public function test_delete_protection()
    {
        $protection = $this->makeProtection();
        $this->response = $this->json('DELETE', '/api/protections/'.$protection->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/protections/'.$protection->id);

        $this->response->assertStatus(404);
    }
}
