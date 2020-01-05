<?php namespace Tests\Repositories;

use App\Models\BotanicalSoil;
use App\Repositories\BotanicalPropagationRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeBotanicalPropagationTrait;
use Tests\ApiTestTrait;

class BotanicalPropagationRepositoryTest extends TestCase
{
    use MakeBotanicalPropagationTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var BotanicalPropagationRepository
     */
    protected $botanicalPropagationRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->botanicalPropagationRepo = \App::make(BotanicalPropagationRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_botanical_propagation()
    {
        $botanicalPropagation = $this->fakeBotanicalPropagationData();
        $createdBotanicalPropagation = $this->botanicalPropagationRepo->create($botanicalPropagation);
        $createdBotanicalPropagation = $createdBotanicalPropagation->toArray();
        $this->assertArrayHasKey('id', $createdBotanicalPropagation);
        $this->assertNotNull($createdBotanicalPropagation['id'], 'Created BotanicalPropagation must have id specified');
        $this->assertNotNull(BotanicalSoil::find($createdBotanicalPropagation['id']), 'BotanicalPropagation with given id must be in DB');
        $this->assertModelData($botanicalPropagation, $createdBotanicalPropagation);
    }

    /**
     * @test read
     */
    public function test_read_botanical_propagation()
    {
        $botanicalPropagation = $this->makeBotanicalPropagation();
        $dbBotanicalPropagation = $this->botanicalPropagationRepo->find($botanicalPropagation->id);
        $dbBotanicalPropagation = $dbBotanicalPropagation->toArray();
        $this->assertModelData($botanicalPropagation->toArray(), $dbBotanicalPropagation);
    }

    /**
     * @test update
     */
    public function test_update_botanical_propagation()
    {
        $botanicalPropagation = $this->makeBotanicalPropagation();
        $fakeBotanicalPropagation = $this->fakeBotanicalPropagationData();
        $updatedBotanicalPropagation = $this->botanicalPropagationRepo->update($fakeBotanicalPropagation, $botanicalPropagation->id);
        $this->assertModelData($fakeBotanicalPropagation, $updatedBotanicalPropagation->toArray());
        $dbBotanicalPropagation = $this->botanicalPropagationRepo->find($botanicalPropagation->id);
        $this->assertModelData($fakeBotanicalPropagation, $dbBotanicalPropagation->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_botanical_propagation()
    {
        $botanicalPropagation = $this->makeBotanicalPropagation();
        $resp = $this->botanicalPropagationRepo->delete($botanicalPropagation->id);
        $this->assertTrue($resp);
        $this->assertNull(BotanicalSoil::find($botanicalPropagation->id), 'BotanicalPropagation should not exist in DB');
    }
}
