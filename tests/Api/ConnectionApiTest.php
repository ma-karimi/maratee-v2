<?php namespace Tests\Api;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeConnectionTrait;
use Tests\ApiTestTrait;

class ConnectionApiTest extends TestCase
{
    use MakeConnectionTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_connection()
    {
        $connection = $this->fakeConnectionData();
        $this->response = $this->json('POST', '/api/connections', $connection);

        $this->assertApiResponse($connection);
    }

    /**
     * @test
     */
    public function test_read_connection()
    {
        $connection = $this->makeConnection();
        $this->response = $this->json('GET', '/api/connections/'.$connection->id);

        $this->assertApiResponse($connection->toArray());
    }

    /**
     * @test
     */
    public function test_update_connection()
    {
        $connection = $this->makeConnection();
        $editedConnection = $this->fakeConnectionData();

        $this->response = $this->json('PUT', '/api/connections/'.$connection->id, $editedConnection);

        $this->assertApiResponse($editedConnection);
    }

    /**
     * @test
     */
    public function test_delete_connection()
    {
        $connection = $this->makeConnection();
        $this->response = $this->json('DELETE', '/api/connections/'.$connection->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/connections/'.$connection->id);

        $this->response->assertStatus(404);
    }
}
