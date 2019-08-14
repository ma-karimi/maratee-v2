<?php namespace Tests\Apis;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeBotanicalPropagationTrait;
use Tests\ApiTestTrait;

class BotanicalPropagationApiTest extends TestCase
{
    use MakeBotanicalPropagationTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_botanical_reproduction()
    {
        $botanicalPropagation = $this->fakeBotanicalPropagationData();
        $this->response = $this->json('POST', '/api/botanicalPropagations', $botanicalPropagation);

        $this->assertApiResponse($botanicalPropagation);
    }

    /**
     * @test
     */
    public function test_read_botanical_reproduction()
    {
        $botanicalPropagation = $this->makeBotanicalPropagation();
        $this->response = $this->json('GET', '/api/botanicalPropagations/'.$botanicalPropagation->id);

        $this->assertApiResponse($botanicalPropagation->toArray());
    }

    /**
     * @test
     */
    public function test_update_botanical_reproduction()
    {
        $botanicalPropagation = $this->makeBotanicalPropagation();
        $editedBotanicalPropagation = $this->fakeBotanicalPropagationData();

        $this->response = $this->json('PUT', '/api/botanicalPropagations/'.$botanicalPropagation->id, $editedBotanicalPropagation);

        $this->assertApiResponse($editedBotanicalPropagation);
    }

    /**
     * @test
     */
    public function test_delete_botanical_reproduction()
    {
        $botanicalPropagation = $this->makeBotanicalPropagation();
        $this->response = $this->json('DELETE', '/api/botanicalPropagations/'.$botanicalPropagation->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/botanicalPropagations/'.$botanicalPropagation->id);

        $this->response->assertStatus(404);
    }
}
