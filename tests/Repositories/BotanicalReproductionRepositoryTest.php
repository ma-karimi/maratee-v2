<?php namespace Tests\Repositories;

use App\Models\BotanicalReproduction;
use App\Repositories\BotanicalReproductionRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeBotanicalReproductionTrait;
use Tests\ApiTestTrait;

class BotanicalReproductionRepositoryTest extends TestCase
{
    use MakeBotanicalReproductionTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var BotanicalReproductionRepository
     */
    protected $botanicalReproductionRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->botanicalReproductionRepo = \App::make(BotanicalReproductionRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_botanical_reproduction()
    {
        $botanicalReproduction = $this->fakeBotanicalReproductionData();
        $createdBotanicalReproduction = $this->botanicalReproductionRepo->create($botanicalReproduction);
        $createdBotanicalReproduction = $createdBotanicalReproduction->toArray();
        $this->assertArrayHasKey('id', $createdBotanicalReproduction);
        $this->assertNotNull($createdBotanicalReproduction['id'], 'Created BotanicalReproduction must have id specified');
        $this->assertNotNull(BotanicalReproduction::find($createdBotanicalReproduction['id']), 'BotanicalReproduction with given id must be in DB');
        $this->assertModelData($botanicalReproduction, $createdBotanicalReproduction);
    }

    /**
     * @test read
     */
    public function test_read_botanical_reproduction()
    {
        $botanicalReproduction = $this->makeBotanicalReproduction();
        $dbBotanicalReproduction = $this->botanicalReproductionRepo->find($botanicalReproduction->id);
        $dbBotanicalReproduction = $dbBotanicalReproduction->toArray();
        $this->assertModelData($botanicalReproduction->toArray(), $dbBotanicalReproduction);
    }

    /**
     * @test update
     */
    public function test_update_botanical_reproduction()
    {
        $botanicalReproduction = $this->makeBotanicalReproduction();
        $fakeBotanicalReproduction = $this->fakeBotanicalReproductionData();
        $updatedBotanicalReproduction = $this->botanicalReproductionRepo->update($fakeBotanicalReproduction, $botanicalReproduction->id);
        $this->assertModelData($fakeBotanicalReproduction, $updatedBotanicalReproduction->toArray());
        $dbBotanicalReproduction = $this->botanicalReproductionRepo->find($botanicalReproduction->id);
        $this->assertModelData($fakeBotanicalReproduction, $dbBotanicalReproduction->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_botanical_reproduction()
    {
        $botanicalReproduction = $this->makeBotanicalReproduction();
        $resp = $this->botanicalReproductionRepo->delete($botanicalReproduction->id);
        $this->assertTrue($resp);
        $this->assertNull(BotanicalReproduction::find($botanicalReproduction->id), 'BotanicalReproduction should not exist in DB');
    }
}
