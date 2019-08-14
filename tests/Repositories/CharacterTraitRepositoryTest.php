<?php namespace Tests\Repositories;

use App\Models\CharacterTrait;
use App\Repositories\CharacterTraitRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeCharacterTraitTrait;
use Tests\ApiTestTrait;

class CharacterTraitRepositoryTest extends TestCase
{
    use MakeCharacterTraitTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var CharacterTraitRepository
     */
    protected $characterTraitRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->characterTraitRepo = \App::make(CharacterTraitRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_character_trait()
    {
        $characterTrait = $this->fakeCharacterTraitData();
        $createdCharacterTrait = $this->characterTraitRepo->create($characterTrait);
        $createdCharacterTrait = $createdCharacterTrait->toArray();
        $this->assertArrayHasKey('id', $createdCharacterTrait);
        $this->assertNotNull($createdCharacterTrait['id'], 'Created CharacterTrait must have id specified');
        $this->assertNotNull(CharacterTrait::find($createdCharacterTrait['id']), 'CharacterTrait with given id must be in DB');
        $this->assertModelData($characterTrait, $createdCharacterTrait);
    }

    /**
     * @test read
     */
    public function test_read_character_trait()
    {
        $characterTrait = $this->makeCharacterTrait();
        $dbCharacterTrait = $this->characterTraitRepo->find($characterTrait->id);
        $dbCharacterTrait = $dbCharacterTrait->toArray();
        $this->assertModelData($characterTrait->toArray(), $dbCharacterTrait);
    }

    /**
     * @test update
     */
    public function test_update_character_trait()
    {
        $characterTrait = $this->makeCharacterTrait();
        $fakeCharacterTrait = $this->fakeCharacterTraitData();
        $updatedCharacterTrait = $this->characterTraitRepo->update($fakeCharacterTrait, $characterTrait->id);
        $this->assertModelData($fakeCharacterTrait, $updatedCharacterTrait->toArray());
        $dbCharacterTrait = $this->characterTraitRepo->find($characterTrait->id);
        $this->assertModelData($fakeCharacterTrait, $dbCharacterTrait->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_character_trait()
    {
        $characterTrait = $this->makeCharacterTrait();
        $resp = $this->characterTraitRepo->delete($characterTrait->id);
        $this->assertTrue($resp);
        $this->assertNull(CharacterTrait::find($characterTrait->id), 'CharacterTrait should not exist in DB');
    }
}
