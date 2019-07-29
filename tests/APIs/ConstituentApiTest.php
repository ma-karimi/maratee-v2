<?php namespace Tests\Apis;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeConstituentTrait;
use Tests\ApiTestTrait;

class ConstituentApiTest extends TestCase
{
    use MakeConstituentTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_constituent()
    {
        $constituent = $this->fakeConstituentData();
        $this->response = $this->json('POST', '/api/constituents', $constituent);

        $this->assertApiResponse($constituent);
    }

    /**
     * @test
     */
    public function test_read_constituent()
    {
        $constituent = $this->makeConstituent();
        $this->response = $this->json('GET', '/api/constituents/'.$constituent->id);

        $this->assertApiResponse($constituent->toArray());
    }

    /**
     * @test
     */
    public function test_update_constituent()
    {
        $constituent = $this->makeConstituent();
        $editedConstituent = $this->fakeConstituentData();

        $this->response = $this->json('PUT', '/api/constituents/'.$constituent->id, $editedConstituent);

        $this->assertApiResponse($editedConstituent);
    }

    /**
     * @test
     */
    public function test_delete_constituent()
    {
        $constituent = $this->makeConstituent();
        $this->response = $this->json('DELETE', '/api/constituents/'.$constituent->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/constituents/'.$constituent->id);

        $this->response->assertStatus(404);
    }
}
