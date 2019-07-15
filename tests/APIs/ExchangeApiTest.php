<?php namespace Tests\Apis;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeExchangeTrait;
use Tests\ApiTestTrait;

class ExchangeApiTest extends TestCase
{
    use MakeExchangeTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_exchange()
    {
        $exchange = $this->fakeExchangeData();
        $this->response = $this->json('POST', '/api/exchanges', $exchange);

        $this->assertApiResponse($exchange);
    }

    /**
     * @test
     */
    public function test_read_exchange()
    {
        $exchange = $this->makeExchange();
        $this->response = $this->json('GET', '/api/exchanges/'.$exchange->id);

        $this->assertApiResponse($exchange->toArray());
    }

    /**
     * @test
     */
    public function test_update_exchange()
    {
        $exchange = $this->makeExchange();
        $editedExchange = $this->fakeExchangeData();

        $this->response = $this->json('PUT', '/api/exchanges/'.$exchange->id, $editedExchange);

        $this->assertApiResponse($editedExchange);
    }

    /**
     * @test
     */
    public function test_delete_exchange()
    {
        $exchange = $this->makeExchange();
        $this->response = $this->json('DELETE', '/api/exchanges/'.$exchange->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/exchanges/'.$exchange->id);

        $this->response->assertStatus(404);
    }
}
