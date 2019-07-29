<?php namespace Tests\Apis;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeMethodTrait;
use Tests\ApiTestTrait;

class MethodApiTest extends TestCase
{
    use MakeMethodTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_method()
    {
        $method = $this->fakeMethodData();
        $this->response = $this->json('POST', '/api/methods', $method);

        $this->assertApiResponse($method);
    }

    /**
     * @test
     */
    public function test_read_method()
    {
        $method = $this->makeMethod();
        $this->response = $this->json('GET', '/api/methods/'.$method->id);

        $this->assertApiResponse($method->toArray());
    }

    /**
     * @test
     */
    public function test_update_method()
    {
        $method = $this->makeMethod();
        $editedMethod = $this->fakeMethodData();

        $this->response = $this->json('PUT', '/api/methods/'.$method->id, $editedMethod);

        $this->assertApiResponse($editedMethod);
    }

    /**
     * @test
     */
    public function test_delete_method()
    {
        $method = $this->makeMethod();
        $this->response = $this->json('DELETE', '/api/methods/'.$method->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/methods/'.$method->id);

        $this->response->assertStatus(404);
    }
}
