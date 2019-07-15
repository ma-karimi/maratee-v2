<?php namespace Tests\Repositories;

use App\Models\SeedWeight;
use App\Repositories\SeedWeightRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeSeedWeightTrait;
use Tests\ApiTestTrait;

class SeedWeightRepositoryTest extends TestCase
{
    use MakeSeedWeightTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var SeedWeightRepository
     */
    protected $seedWeightRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->seedWeightRepo = \App::make(SeedWeightRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_seed_weight()
    {
        $seedWeight = $this->fakeSeedWeightData();
        $createdSeedWeight = $this->seedWeightRepo->create($seedWeight);
        $createdSeedWeight = $createdSeedWeight->toArray();
        $this->assertArrayHasKey('id', $createdSeedWeight);
        $this->assertNotNull($createdSeedWeight['id'], 'Created SeedWeight must have id specified');
        $this->assertNotNull(SeedWeight::find($createdSeedWeight['id']), 'SeedWeight with given id must be in DB');
        $this->assertModelData($seedWeight, $createdSeedWeight);
    }

    /**
     * @test read
     */
    public function test_read_seed_weight()
    {
        $seedWeight = $this->makeSeedWeight();
        $dbSeedWeight = $this->seedWeightRepo->find($seedWeight->id);
        $dbSeedWeight = $dbSeedWeight->toArray();
        $this->assertModelData($seedWeight->toArray(), $dbSeedWeight);
    }

    /**
     * @test update
     */
    public function test_update_seed_weight()
    {
        $seedWeight = $this->makeSeedWeight();
        $fakeSeedWeight = $this->fakeSeedWeightData();
        $updatedSeedWeight = $this->seedWeightRepo->update($fakeSeedWeight, $seedWeight->id);
        $this->assertModelData($fakeSeedWeight, $updatedSeedWeight->toArray());
        $dbSeedWeight = $this->seedWeightRepo->find($seedWeight->id);
        $this->assertModelData($fakeSeedWeight, $dbSeedWeight->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_seed_weight()
    {
        $seedWeight = $this->makeSeedWeight();
        $resp = $this->seedWeightRepo->delete($seedWeight->id);
        $this->assertTrue($resp);
        $this->assertNull(SeedWeight::find($seedWeight->id), 'SeedWeight should not exist in DB');
    }
}
