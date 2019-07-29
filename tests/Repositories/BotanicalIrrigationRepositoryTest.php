<?php namespace Tests\Repositories;

use App\Models\BotanicalIrrigation;
use App\Repositories\BotanicalIrrigationRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeBotanicalIrrigationTrait;
use Tests\ApiTestTrait;

class BotanicalIrrigationRepositoryTest extends TestCase
{
    use MakeBotanicalIrrigationTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var BotanicalIrrigationRepository
     */
    protected $botanicalIrrigationRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->botanicalIrrigationRepo = \App::make(BotanicalIrrigationRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_botanical_irrigation()
    {
        $botanicalIrrigation = $this->fakeBotanicalIrrigationData();
        $createdBotanicalIrrigation = $this->botanicalIrrigationRepo->create($botanicalIrrigation);
        $createdBotanicalIrrigation = $createdBotanicalIrrigation->toArray();
        $this->assertArrayHasKey('id', $createdBotanicalIrrigation);
        $this->assertNotNull($createdBotanicalIrrigation['id'], 'Created BotanicalIrrigation must have id specified');
        $this->assertNotNull(BotanicalIrrigation::find($createdBotanicalIrrigation['id']), 'BotanicalIrrigation with given id must be in DB');
        $this->assertModelData($botanicalIrrigation, $createdBotanicalIrrigation);
    }

    /**
     * @test read
     */
    public function test_read_botanical_irrigation()
    {
        $botanicalIrrigation = $this->makeBotanicalIrrigation();
        $dbBotanicalIrrigation = $this->botanicalIrrigationRepo->find($botanicalIrrigation->id);
        $dbBotanicalIrrigation = $dbBotanicalIrrigation->toArray();
        $this->assertModelData($botanicalIrrigation->toArray(), $dbBotanicalIrrigation);
    }

    /**
     * @test update
     */
    public function test_update_botanical_irrigation()
    {
        $botanicalIrrigation = $this->makeBotanicalIrrigation();
        $fakeBotanicalIrrigation = $this->fakeBotanicalIrrigationData();
        $updatedBotanicalIrrigation = $this->botanicalIrrigationRepo->update($fakeBotanicalIrrigation, $botanicalIrrigation->id);
        $this->assertModelData($fakeBotanicalIrrigation, $updatedBotanicalIrrigation->toArray());
        $dbBotanicalIrrigation = $this->botanicalIrrigationRepo->find($botanicalIrrigation->id);
        $this->assertModelData($fakeBotanicalIrrigation, $dbBotanicalIrrigation->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_botanical_irrigation()
    {
        $botanicalIrrigation = $this->makeBotanicalIrrigation();
        $resp = $this->botanicalIrrigationRepo->delete($botanicalIrrigation->id);
        $this->assertTrue($resp);
        $this->assertNull(BotanicalIrrigation::find($botanicalIrrigation->id), 'BotanicalIrrigation should not exist in DB');
    }
}
