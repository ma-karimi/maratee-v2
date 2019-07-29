<?php namespace Tests\Api;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeSeedExchangeTrait;
use Tests\ApiTestTrait;

class SeedExchangeApiTest extends TestCase
{
    use MakeSeedExchangeTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_seed_exchange()
    {
        $seedExchange = $this->fakeSeedExchangeData();
        $this->response = $this->json('POST', '/api/seedExchanges', $seedExchange);

        $this->assertApiResponse($seedExchange);
    }

    /**
     * @test
     */
    public function test_read_seed_exchange()
    {
        $seedExchange = $this->makeSeedExchange();
        $this->response = $this->json('GET', '/api/seedExchanges/'.$seedExchange->id);

        $this->assertApiResponse($seedExchange->toArray());
    }

    /**
     * @test
     */
    public function test_update_seed_exchange()
    {
        $seedExchange = $this->makeSeedExchange();
        $editedSeedExchange = $this->fakeSeedExchangeData();

        $this->response = $this->json('PUT', '/api/seedExchanges/'.$seedExchange->id, $editedSeedExchange);

        $this->assertApiResponse($editedSeedExchange);
    }

    /**
     * @test
     */
    public function test_delete_seed_exchange()
    {
        $seedExchange = $this->makeSeedExchange();
        $this->response = $this->json('DELETE', '/api/seedExchanges/'.$seedExchange->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/seedExchanges/'.$seedExchange->id);

        $this->response->assertStatus(404);
    }
}
