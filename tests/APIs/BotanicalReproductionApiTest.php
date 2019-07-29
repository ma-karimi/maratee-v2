<?php namespace Tests\Apis;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeBotanicalReproductionTrait;
use Tests\ApiTestTrait;

class BotanicalReproductionApiTest extends TestCase
{
    use MakeBotanicalReproductionTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_botanical_reproduction()
    {
        $botanicalReproduction = $this->fakeBotanicalReproductionData();
        $this->response = $this->json('POST', '/api/botanicalReproductions', $botanicalReproduction);

        $this->assertApiResponse($botanicalReproduction);
    }

    /**
     * @test
     */
    public function test_read_botanical_reproduction()
    {
        $botanicalReproduction = $this->makeBotanicalReproduction();
        $this->response = $this->json('GET', '/api/botanicalReproductions/'.$botanicalReproduction->id);

        $this->assertApiResponse($botanicalReproduction->toArray());
    }

    /**
     * @test
     */
    public function test_update_botanical_reproduction()
    {
        $botanicalReproduction = $this->makeBotanicalReproduction();
        $editedBotanicalReproduction = $this->fakeBotanicalReproductionData();

        $this->response = $this->json('PUT', '/api/botanicalReproductions/'.$botanicalReproduction->id, $editedBotanicalReproduction);

        $this->assertApiResponse($editedBotanicalReproduction);
    }

    /**
     * @test
     */
    public function test_delete_botanical_reproduction()
    {
        $botanicalReproduction = $this->makeBotanicalReproduction();
        $this->response = $this->json('DELETE', '/api/botanicalReproductions/'.$botanicalReproduction->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/botanicalReproductions/'.$botanicalReproduction->id);

        $this->response->assertStatus(404);
    }
}
