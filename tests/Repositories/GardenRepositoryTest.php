<?php namespace Tests\Repositories;

use App\Models\InternalHabitat;
use App\Repositories\InternalHabitatRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeGardenTrait;
use Tests\ApiTestTrait;

class GardenRepositoryTest extends TestCase
{
    use MakeGardenTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var InternalHabitatRepository
     */
    protected $gardenRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->gardenRepo = \App::make(InternalHabitatRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_garden()
    {
        $garden = $this->fakeGardenData();
        $createdGarden = $this->gardenRepo->create($garden);
        $createdGarden = $createdGarden->toArray();
        $this->assertArrayHasKey('id', $createdGarden);
        $this->assertNotNull($createdGarden['id'], 'Created Garden must have id specified');
        $this->assertNotNull(InternalHabitat::find($createdGarden['id']), 'Garden with given id must be in DB');
        $this->assertModelData($garden, $createdGarden);
    }

    /**
     * @test read
     */
    public function test_read_garden()
    {
        $garden = $this->makeGarden();
        $dbGarden = $this->gardenRepo->find($garden->id);
        $dbGarden = $dbGarden->toArray();
        $this->assertModelData($garden->toArray(), $dbGarden);
    }

    /**
     * @test update
     */
    public function test_update_garden()
    {
        $garden = $this->makeGarden();
        $fakeGarden = $this->fakeGardenData();
        $updatedGarden = $this->gardenRepo->update($fakeGarden, $garden->id);
        $this->assertModelData($fakeGarden, $updatedGarden->toArray());
        $dbGarden = $this->gardenRepo->find($garden->id);
        $this->assertModelData($fakeGarden, $dbGarden->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_garden()
    {
        $garden = $this->makeGarden();
        $resp = $this->gardenRepo->delete($garden->id);
        $this->assertTrue($resp);
        $this->assertNull(InternalHabitat::find($garden->id), 'Garden should not exist in DB');
    }
}
