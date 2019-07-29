<?php namespace Tests\Repositories;

use App\Models\BotanicalGardenAction;
use App\Repositories\BotanicalGardenActionRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeBotanicalGardenActionTrait;
use Tests\ApiTestTrait;

class BotanicalGardenActionRepositoryTest extends TestCase
{
    use MakeBotanicalGardenActionTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var BotanicalGardenActionRepository
     */
    protected $botanicalGardenActionRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->botanicalGardenActionRepo = \App::make(BotanicalGardenActionRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_botanical_garden_action()
    {
        $botanicalGardenAction = $this->fakeBotanicalGardenActionData();
        $createdBotanicalGardenAction = $this->botanicalGardenActionRepo->create($botanicalGardenAction);
        $createdBotanicalGardenAction = $createdBotanicalGardenAction->toArray();
        $this->assertArrayHasKey('id', $createdBotanicalGardenAction);
        $this->assertNotNull($createdBotanicalGardenAction['id'], 'Created BotanicalGardenAction must have id specified');
        $this->assertNotNull(BotanicalGardenAction::find($createdBotanicalGardenAction['id']), 'BotanicalGardenAction with given id must be in DB');
        $this->assertModelData($botanicalGardenAction, $createdBotanicalGardenAction);
    }

    /**
     * @test read
     */
    public function test_read_botanical_garden_action()
    {
        $botanicalGardenAction = $this->makeBotanicalGardenAction();
        $dbBotanicalGardenAction = $this->botanicalGardenActionRepo->find($botanicalGardenAction->id);
        $dbBotanicalGardenAction = $dbBotanicalGardenAction->toArray();
        $this->assertModelData($botanicalGardenAction->toArray(), $dbBotanicalGardenAction);
    }

    /**
     * @test update
     */
    public function test_update_botanical_garden_action()
    {
        $botanicalGardenAction = $this->makeBotanicalGardenAction();
        $fakeBotanicalGardenAction = $this->fakeBotanicalGardenActionData();
        $updatedBotanicalGardenAction = $this->botanicalGardenActionRepo->update($fakeBotanicalGardenAction, $botanicalGardenAction->id);
        $this->assertModelData($fakeBotanicalGardenAction, $updatedBotanicalGardenAction->toArray());
        $dbBotanicalGardenAction = $this->botanicalGardenActionRepo->find($botanicalGardenAction->id);
        $this->assertModelData($fakeBotanicalGardenAction, $dbBotanicalGardenAction->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_botanical_garden_action()
    {
        $botanicalGardenAction = $this->makeBotanicalGardenAction();
        $resp = $this->botanicalGardenActionRepo->delete($botanicalGardenAction->id);
        $this->assertTrue($resp);
        $this->assertNull(BotanicalGardenAction::find($botanicalGardenAction->id), 'BotanicalGardenAction should not exist in DB');
    }
}
