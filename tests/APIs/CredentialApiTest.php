<?php namespace Tests\Apis;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeCredentialTrait;
use Tests\ApiTestTrait;

class CredentialApiTest extends TestCase
{
    use MakeCredentialTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_credential()
    {
        $credential = $this->fakeCredentialData();
        $this->response = $this->json('POST', '/api/credentials', $credential);

        $this->assertApiResponse($credential);
    }

    /**
     * @test
     */
    public function test_read_credential()
    {
        $credential = $this->makeCredential();
        $this->response = $this->json('GET', '/api/credentials/'.$credential->id);

        $this->assertApiResponse($credential->toArray());
    }

    /**
     * @test
     */
    public function test_update_credential()
    {
        $credential = $this->makeCredential();
        $editedCredential = $this->fakeCredentialData();

        $this->response = $this->json('PUT', '/api/credentials/'.$credential->id, $editedCredential);

        $this->assertApiResponse($editedCredential);
    }

    /**
     * @test
     */
    public function test_delete_credential()
    {
        $credential = $this->makeCredential();
        $this->response = $this->json('DELETE', '/api/credentials/'.$credential->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/credentials/'.$credential->id);

        $this->response->assertStatus(404);
    }
}
