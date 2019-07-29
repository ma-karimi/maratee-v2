<?php namespace Tests\Repositories;

use App\Models\CryoBankAction;
use App\Repositories\CryoBankActionRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeCryoBankActionTrait;
use Tests\ApiTestTrait;

class CryoBankActionRepositoryTest extends TestCase
{
    use MakeCryoBankActionTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var CryoBankActionRepository
     */
    protected $cryoBankActionRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->cryoBankActionRepo = \App::make(CryoBankActionRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_cryo_bank_action()
    {
        $cryoBankAction = $this->fakeCryoBankActionData();
        $createdCryoBankAction = $this->cryoBankActionRepo->create($cryoBankAction);
        $createdCryoBankAction = $createdCryoBankAction->toArray();
        $this->assertArrayHasKey('id', $createdCryoBankAction);
        $this->assertNotNull($createdCryoBankAction['id'], 'Created CryoBankAction must have id specified');
        $this->assertNotNull(CryoBankAction::find($createdCryoBankAction['id']), 'CryoBankAction with given id must be in DB');
        $this->assertModelData($cryoBankAction, $createdCryoBankAction);
    }

    /**
     * @test read
     */
    public function test_read_cryo_bank_action()
    {
        $cryoBankAction = $this->makeCryoBankAction();
        $dbCryoBankAction = $this->cryoBankActionRepo->find($cryoBankAction->id);
        $dbCryoBankAction = $dbCryoBankAction->toArray();
        $this->assertModelData($cryoBankAction->toArray(), $dbCryoBankAction);
    }

    /**
     * @test update
     */
    public function test_update_cryo_bank_action()
    {
        $cryoBankAction = $this->makeCryoBankAction();
        $fakeCryoBankAction = $this->fakeCryoBankActionData();
        $updatedCryoBankAction = $this->cryoBankActionRepo->update($fakeCryoBankAction, $cryoBankAction->id);
        $this->assertModelData($fakeCryoBankAction, $updatedCryoBankAction->toArray());
        $dbCryoBankAction = $this->cryoBankActionRepo->find($cryoBankAction->id);
        $this->assertModelData($fakeCryoBankAction, $dbCryoBankAction->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_cryo_bank_action()
    {
        $cryoBankAction = $this->makeCryoBankAction();
        $resp = $this->cryoBankActionRepo->delete($cryoBankAction->id);
        $this->assertTrue($resp);
        $this->assertNull(CryoBankAction::find($cryoBankAction->id), 'CryoBankAction should not exist in DB');
    }
}
