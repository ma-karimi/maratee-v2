<?php namespace Tests\Repositories;

use App\Models\PaleontologyAction;
use App\Repositories\PaleontologyActionRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakePaleontologyActionTrait;
use Tests\ApiTestTrait;

class PaleontologyActionRepositoryTest extends TestCase
{
    use MakePaleontologyActionTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var PaleontologyActionRepository
     */
    protected $paleontologyActionRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->paleontologyActionRepo = \App::make(PaleontologyActionRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_paleontology_action()
    {
        $paleontologyAction = $this->fakePaleontologyActionData();
        $createdPaleontologyAction = $this->paleontologyActionRepo->create($paleontologyAction);
        $createdPaleontologyAction = $createdPaleontologyAction->toArray();
        $this->assertArrayHasKey('id', $createdPaleontologyAction);
        $this->assertNotNull($createdPaleontologyAction['id'], 'Created PaleontologyAction must have id specified');
        $this->assertNotNull(PaleontologyAction::find($createdPaleontologyAction['id']), 'PaleontologyAction with given id must be in DB');
        $this->assertModelData($paleontologyAction, $createdPaleontologyAction);
    }

    /**
     * @test read
     */
    public function test_read_paleontology_action()
    {
        $paleontologyAction = $this->makePaleontologyAction();
        $dbPaleontologyAction = $this->paleontologyActionRepo->find($paleontologyAction->id);
        $dbPaleontologyAction = $dbPaleontologyAction->toArray();
        $this->assertModelData($paleontologyAction->toArray(), $dbPaleontologyAction);
    }

    /**
     * @test update
     */
    public function test_update_paleontology_action()
    {
        $paleontologyAction = $this->makePaleontologyAction();
        $fakePaleontologyAction = $this->fakePaleontologyActionData();
        $updatedPaleontologyAction = $this->paleontologyActionRepo->update($fakePaleontologyAction, $paleontologyAction->id);
        $this->assertModelData($fakePaleontologyAction, $updatedPaleontologyAction->toArray());
        $dbPaleontologyAction = $this->paleontologyActionRepo->find($paleontologyAction->id);
        $this->assertModelData($fakePaleontologyAction, $dbPaleontologyAction->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_paleontology_action()
    {
        $paleontologyAction = $this->makePaleontologyAction();
        $resp = $this->paleontologyActionRepo->delete($paleontologyAction->id);
        $this->assertTrue($resp);
        $this->assertNull(PaleontologyAction::find($paleontologyAction->id), 'PaleontologyAction should not exist in DB');
    }
}
