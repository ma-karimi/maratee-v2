<?php namespace Tests\Apis;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeBotanicalIrrigationTrait;
use Tests\ApiTestTrait;

class BotanicalIrrigationApiTest extends TestCase
{
    use MakeBotanicalIrrigationTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_botanical_irrigation()
    {
        $botanicalIrrigation = $this->fakeBotanicalIrrigationData();
        $this->response = $this->json('POST', '/api/botanicalIrrigations', $botanicalIrrigation);

        $this->assertApiResponse($botanicalIrrigation);
    }

    /**
     * @test
     */
    public function test_read_botanical_irrigation()
    {
        $botanicalIrrigation = $this->makeBotanicalIrrigation();
        $this->response = $this->json('GET', '/api/botanicalIrrigations/'.$botanicalIrrigation->id);

        $this->assertApiResponse($botanicalIrrigation->toArray());
    }

    /**
     * @test
     */
    public function test_update_botanical_irrigation()
    {
        $botanicalIrrigation = $this->makeBotanicalIrrigation();
        $editedBotanicalIrrigation = $this->fakeBotanicalIrrigationData();

        $this->response = $this->json('PUT', '/api/botanicalIrrigations/'.$botanicalIrrigation->id, $editedBotanicalIrrigation);

        $this->assertApiResponse($editedBotanicalIrrigation);
    }

    /**
     * @test
     */
    public function test_delete_botanical_irrigation()
    {
        $botanicalIrrigation = $this->makeBotanicalIrrigation();
        $this->response = $this->json('DELETE', '/api/botanicalIrrigations/'.$botanicalIrrigation->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/botanicalIrrigations/'.$botanicalIrrigation->id);

        $this->response->assertStatus(404);
    }
}
