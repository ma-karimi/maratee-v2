<?php namespace Tests\Repositories;

use App\Models\Herbarium;
use App\Repositories\HerbariumRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeHerbariumTrait;
use Tests\ApiTestTrait;

class HerbariumRepositoryTest extends TestCase
{
    use MakeHerbariumTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var HerbariumRepository
     */
    protected $herbariumRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->herbariumRepo = \App::make(HerbariumRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_herbarium()
    {
        $herbarium = $this->fakeHerbariumData();
        $createdHerbarium = $this->herbariumRepo->create($herbarium);
        $createdHerbarium = $createdHerbarium->toArray();
        $this->assertArrayHasKey('id', $createdHerbarium);
        $this->assertNotNull($createdHerbarium['id'], 'Created Herbarium must have id specified');
        $this->assertNotNull(Herbarium::find($createdHerbarium['id']), 'Herbarium with given id must be in DB');
        $this->assertModelData($herbarium, $createdHerbarium);
    }

    /**
     * @test read
     */
    public function test_read_herbarium()
    {
        $herbarium = $this->makeHerbarium();
        $dbHerbarium = $this->herbariumRepo->find($herbarium->id);
        $dbHerbarium = $dbHerbarium->toArray();
        $this->assertModelData($herbarium->toArray(), $dbHerbarium);
    }

    /**
     * @test update
     */
    public function test_update_herbarium()
    {
        $herbarium = $this->makeHerbarium();
        $fakeHerbarium = $this->fakeHerbariumData();
        $updatedHerbarium = $this->herbariumRepo->update($fakeHerbarium, $herbarium->id);
        $this->assertModelData($fakeHerbarium, $updatedHerbarium->toArray());
        $dbHerbarium = $this->herbariumRepo->find($herbarium->id);
        $this->assertModelData($fakeHerbarium, $dbHerbarium->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_herbarium()
    {
        $herbarium = $this->makeHerbarium();
        $resp = $this->herbariumRepo->delete($herbarium->id);
        $this->assertTrue($resp);
        $this->assertNull(Herbarium::find($herbarium->id), 'Herbarium should not exist in DB');
    }
}
