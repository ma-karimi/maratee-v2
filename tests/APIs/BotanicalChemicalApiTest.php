<?php namespace Tests\Apis;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeBotanicalChemicalTrait;
use Tests\ApiTestTrait;

class BotanicalChemicalApiTest extends TestCase
{
    use MakeBotanicalChemicalTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_botanical_chemical()
    {
        $botanicalChemical = $this->fakeBotanicalChemicalData();
        $this->response = $this->json('POST', '/api/botanicalChemicals', $botanicalChemical);

        $this->assertApiResponse($botanicalChemical);
    }

    /**
     * @test
     */
    public function test_read_botanical_chemical()
    {
        $botanicalChemical = $this->makeBotanicalChemical();
        $this->response = $this->json('GET', '/api/botanicalChemicals/'.$botanicalChemical->id);

        $this->assertApiResponse($botanicalChemical->toArray());
    }

    /**
     * @test
     */
    public function test_update_botanical_chemical()
    {
        $botanicalChemical = $this->makeBotanicalChemical();
        $editedBotanicalChemical = $this->fakeBotanicalChemicalData();

        $this->response = $this->json('PUT', '/api/botanicalChemicals/'.$botanicalChemical->id, $editedBotanicalChemical);

        $this->assertApiResponse($editedBotanicalChemical);
    }

    /**
     * @test
     */
    public function test_delete_botanical_chemical()
    {
        $botanicalChemical = $this->makeBotanicalChemical();
        $this->response = $this->json('DELETE', '/api/botanicalChemicals/'.$botanicalChemical->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/botanicalChemicals/'.$botanicalChemical->id);

        $this->response->assertStatus(404);
    }
}
