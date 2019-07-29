<?php namespace Tests\Repositories;

use App\Models\Irrigation;
use App\Repositories\IrrigationRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeIrrigationTrait;
use Tests\ApiTestTrait;

class IrrigationRepositoryTest extends TestCase
{
    use MakeIrrigationTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var IrrigationRepository
     */
    protected $irrigationRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->irrigationRepo = \App::make(IrrigationRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_irrigation()
    {
        $irrigation = $this->fakeIrrigationData();
        $createdIrrigation = $this->irrigationRepo->create($irrigation);
        $createdIrrigation = $createdIrrigation->toArray();
        $this->assertArrayHasKey('id', $createdIrrigation);
        $this->assertNotNull($createdIrrigation['id'], 'Created Irrigation must have id specified');
        $this->assertNotNull(Irrigation::find($createdIrrigation['id']), 'Irrigation with given id must be in DB');
        $this->assertModelData($irrigation, $createdIrrigation);
    }

    /**
     * @test read
     */
    public function test_read_irrigation()
    {
        $irrigation = $this->makeIrrigation();
        $dbIrrigation = $this->irrigationRepo->find($irrigation->id);
        $dbIrrigation = $dbIrrigation->toArray();
        $this->assertModelData($irrigation->toArray(), $dbIrrigation);
    }

    /**
     * @test update
     */
    public function test_update_irrigation()
    {
        $irrigation = $this->makeIrrigation();
        $fakeIrrigation = $this->fakeIrrigationData();
        $updatedIrrigation = $this->irrigationRepo->update($fakeIrrigation, $irrigation->id);
        $this->assertModelData($fakeIrrigation, $updatedIrrigation->toArray());
        $dbIrrigation = $this->irrigationRepo->find($irrigation->id);
        $this->assertModelData($fakeIrrigation, $dbIrrigation->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_irrigation()
    {
        $irrigation = $this->makeIrrigation();
        $resp = $this->irrigationRepo->delete($irrigation->id);
        $this->assertTrue($resp);
        $this->assertNull(Irrigation::find($irrigation->id), 'Irrigation should not exist in DB');
    }
}
