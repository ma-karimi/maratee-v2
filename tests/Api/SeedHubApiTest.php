<?php namespace Tests\Api;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeSeedHubTrait;
use Tests\ApiTestTrait;

class SeedHubApiTest extends TestCase
{
    use MakeSeedHubTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_seed_hub()
    {
        $seedHub = $this->fakeSeedHubData();
        $this->response = $this->json('POST', '/api/seedHubs', $seedHub);

        $this->assertApiResponse($seedHub);
    }

    /**
     * @test
     */
    public function test_read_seed_hub()
    {
        $seedHub = $this->makeSeedHub();
        $this->response = $this->json('GET', '/api/seedHubs/'.$seedHub->id);

        $this->assertApiResponse($seedHub->toArray());
    }

    /**
     * @test
     */
    public function test_update_seed_hub()
    {
        $seedHub = $this->makeSeedHub();
        $editedSeedHub = $this->fakeSeedHubData();

        $this->response = $this->json('PUT', '/api/seedHubs/'.$seedHub->id, $editedSeedHub);

        $this->assertApiResponse($editedSeedHub);
    }

    /**
     * @test
     */
    public function test_delete_seed_hub()
    {
        $seedHub = $this->makeSeedHub();
        $this->response = $this->json('DELETE', '/api/seedHubs/'.$seedHub->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/seedHubs/'.$seedHub->id);

        $this->response->assertStatus(404);
    }
}
