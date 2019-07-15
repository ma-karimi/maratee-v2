<?php namespace Tests\Apis;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeBotanicalTrait;
use Tests\ApiTestTrait;

class BotanicalApiTest extends TestCase
{
    use MakeBotanicalTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_botanical()
    {
        $botanical = $this->fakeBotanicalData();
        $this->response = $this->json('POST', '/api/botanicals', $botanical);

        $this->assertApiResponse($botanical);
    }

    /**
     * @test
     */
    public function test_read_botanical()
    {
        $botanical = $this->makeBotanical();
        $this->response = $this->json('GET', '/api/botanicals/'.$botanical->id);

        $this->assertApiResponse($botanical->toArray());
    }

    /**
     * @test
     */
    public function test_update_botanical()
    {
        $botanical = $this->makeBotanical();
        $editedBotanical = $this->fakeBotanicalData();

        $this->response = $this->json('PUT', '/api/botanicals/'.$botanical->id, $editedBotanical);

        $this->assertApiResponse($editedBotanical);
    }

    /**
     * @test
     */
    public function test_delete_botanical()
    {
        $botanical = $this->makeBotanical();
        $this->response = $this->json('DELETE', '/api/botanicals/'.$botanical->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/botanicals/'.$botanical->id);

        $this->response->assertStatus(404);
    }
}
