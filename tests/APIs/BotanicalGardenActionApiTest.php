<?php namespace Tests\Apis;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeBotanicalGardenActionTrait;
use Tests\ApiTestTrait;

class BotanicalGardenActionApiTest extends TestCase
{
    use MakeBotanicalGardenActionTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_botanical_garden_action()
    {
        $botanicalGardenAction = $this->fakeBotanicalGardenActionData();
        $this->response = $this->json('POST', '/api/botanicalGardenActions', $botanicalGardenAction);

        $this->assertApiResponse($botanicalGardenAction);
    }

    /**
     * @test
     */
    public function test_read_botanical_garden_action()
    {
        $botanicalGardenAction = $this->makeBotanicalGardenAction();
        $this->response = $this->json('GET', '/api/botanicalGardenActions/'.$botanicalGardenAction->id);

        $this->assertApiResponse($botanicalGardenAction->toArray());
    }

    /**
     * @test
     */
    public function test_update_botanical_garden_action()
    {
        $botanicalGardenAction = $this->makeBotanicalGardenAction();
        $editedBotanicalGardenAction = $this->fakeBotanicalGardenActionData();

        $this->response = $this->json('PUT', '/api/botanicalGardenActions/'.$botanicalGardenAction->id, $editedBotanicalGardenAction);

        $this->assertApiResponse($editedBotanicalGardenAction);
    }

    /**
     * @test
     */
    public function test_delete_botanical_garden_action()
    {
        $botanicalGardenAction = $this->makeBotanicalGardenAction();
        $this->response = $this->json('DELETE', '/api/botanicalGardenActions/'.$botanicalGardenAction->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/botanicalGardenActions/'.$botanicalGardenAction->id);

        $this->response->assertStatus(404);
    }
}
