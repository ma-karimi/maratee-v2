<?php namespace Tests\Api;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeCharacterTrait;
use Tests\ApiTestTrait;

class CharacterApiTest extends TestCase
{
    use MakeCharacterTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_character()
    {
        $character = $this->fakeCharacterData();
        $this->response = $this->json('POST', '/api/characters', $character);

        $this->assertApiResponse($character);
    }

    /**
     * @test
     */
    public function test_read_character()
    {
        $character = $this->makeCharacter();
        $this->response = $this->json('GET', '/api/characters/'.$character->id);

        $this->assertApiResponse($character->toArray());
    }

    /**
     * @test
     */
    public function test_update_character()
    {
        $character = $this->makeCharacter();
        $editedCharacter = $this->fakeCharacterData();

        $this->response = $this->json('PUT', '/api/characters/'.$character->id, $editedCharacter);

        $this->assertApiResponse($editedCharacter);
    }

    /**
     * @test
     */
    public function test_delete_character()
    {
        $character = $this->makeCharacter();
        $this->response = $this->json('DELETE', '/api/characters/'.$character->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/characters/'.$character->id);

        $this->response->assertStatus(404);
    }
}
