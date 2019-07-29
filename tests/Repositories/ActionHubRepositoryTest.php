<?php namespace Tests\Repositories;

use App\Models\ActionHub;
use App\Repositories\ActionHubRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeActionHubTrait;
use Tests\ApiTestTrait;

class ActionHubRepositoryTest extends TestCase
{
    use MakeActionHubTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ActionHubRepository
     */
    protected $actionHubRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->actionHubRepo = \App::make(ActionHubRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_action_hub()
    {
        $actionHub = $this->fakeActionHubData();
        $createdActionHub = $this->actionHubRepo->create($actionHub);
        $createdActionHub = $createdActionHub->toArray();
        $this->assertArrayHasKey('id', $createdActionHub);
        $this->assertNotNull($createdActionHub['id'], 'Created ActionHub must have id specified');
        $this->assertNotNull(ActionHub::find($createdActionHub['id']), 'ActionHub with given id must be in DB');
        $this->assertModelData($actionHub, $createdActionHub);
    }

    /**
     * @test read
     */
    public function test_read_action_hub()
    {
        $actionHub = $this->makeActionHub();
        $dbActionHub = $this->actionHubRepo->find($actionHub->id);
        $dbActionHub = $dbActionHub->toArray();
        $this->assertModelData($actionHub->toArray(), $dbActionHub);
    }

    /**
     * @test update
     */
    public function test_update_action_hub()
    {
        $actionHub = $this->makeActionHub();
        $fakeActionHub = $this->fakeActionHubData();
        $updatedActionHub = $this->actionHubRepo->update($fakeActionHub, $actionHub->id);
        $this->assertModelData($fakeActionHub, $updatedActionHub->toArray());
        $dbActionHub = $this->actionHubRepo->find($actionHub->id);
        $this->assertModelData($fakeActionHub, $dbActionHub->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_action_hub()
    {
        $actionHub = $this->makeActionHub();
        $resp = $this->actionHubRepo->delete($actionHub->id);
        $this->assertTrue($resp);
        $this->assertNull(ActionHub::find($actionHub->id), 'ActionHub should not exist in DB');
    }
}
