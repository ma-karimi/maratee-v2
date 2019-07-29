<?php namespace Tests\Repositories;

use App\Models\Botanical;
use App\Repositories\BotanicalRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeBotanicalTrait;
use Tests\ApiTestTrait;

class BotanicalRepositoryTest extends TestCase
{
    use MakeBotanicalTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var BotanicalRepository
     */
    protected $botanicalRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->botanicalRepo = \App::make(BotanicalRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_botanical()
    {
        $botanical = $this->fakeBotanicalData();
        $createdBotanical = $this->botanicalRepo->create($botanical);
        $createdBotanical = $createdBotanical->toArray();
        $this->assertArrayHasKey('id', $createdBotanical);
        $this->assertNotNull($createdBotanical['id'], 'Created Botanical must have id specified');
        $this->assertNotNull(Botanical::find($createdBotanical['id']), 'Botanical with given id must be in DB');
        $this->assertModelData($botanical, $createdBotanical);
    }

    /**
     * @test read
     */
    public function test_read_botanical()
    {
        $botanical = $this->makeBotanical();
        $dbBotanical = $this->botanicalRepo->find($botanical->id);
        $dbBotanical = $dbBotanical->toArray();
        $this->assertModelData($botanical->toArray(), $dbBotanical);
    }

    /**
     * @test update
     */
    public function test_update_botanical()
    {
        $botanical = $this->makeBotanical();
        $fakeBotanical = $this->fakeBotanicalData();
        $updatedBotanical = $this->botanicalRepo->update($fakeBotanical, $botanical->id);
        $this->assertModelData($fakeBotanical, $updatedBotanical->toArray());
        $dbBotanical = $this->botanicalRepo->find($botanical->id);
        $this->assertModelData($fakeBotanical, $dbBotanical->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_botanical()
    {
        $botanical = $this->makeBotanical();
        $resp = $this->botanicalRepo->delete($botanical->id);
        $this->assertTrue($resp);
        $this->assertNull(Botanical::find($botanical->id), 'Botanical should not exist in DB');
    }
}
