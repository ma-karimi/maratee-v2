<?php namespace Tests\Api;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeCharacterTraitTrait;
use Tests\ApiTestTrait;

class CharacterTraitApiTest extends TestCase
{
    use MakeCharacterTraitTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_character_trait()
    {
        $characterTrait = $this->fakeCharacterTraitData();
        $this->response = $this->json('POST', '/api/characterTraits', $characterTrait);

        $this->assertApiResponse($characterTrait);
    }

    /**
     * @test
     */
    public function test_read_character_trait()
    {
        $characterTrait = $this->makeCharacterTrait();
        $this->response = $this->json('GET', '/api/characterTraits/'.$characterTrait->id);

        $this->assertApiResponse($characterTrait->toArray());
    }

    /**
     * @test
     */
    public function test_update_character_trait()
    {
        $characterTrait = $this->makeCharacterTrait();
        $editedCharacterTrait = $this->fakeCharacterTraitData();

        $this->response = $this->json('PUT', '/api/characterTraits/'.$characterTrait->id, $editedCharacterTrait);

        $this->assertApiResponse($editedCharacterTrait);
    }

    /**
     * @test
     */
    public function test_delete_character_trait()
    {
        $characterTrait = $this->makeCharacterTrait();
        $this->response = $this->json('DELETE', '/api/characterTraits/'.$characterTrait->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/characterTraits/'.$characterTrait->id);

        $this->response->assertStatus(404);
    }
}
