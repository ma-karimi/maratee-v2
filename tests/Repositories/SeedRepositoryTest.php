<?php namespace Tests\Repositories;

use App\Models\Seed;
use App\Repositories\SeedRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeSeedTrait;
use Tests\ApiTestTrait;

class SeedRepositoryTest extends TestCase
{
    use MakeSeedTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var SeedRepository
     */
    protected $seedRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->seedRepo = \App::make(SeedRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_seed()
    {
        $seed = $this->fakeSeedData();
        $createdSeed = $this->seedRepo->create($seed);
        $createdSeed = $createdSeed->toArray();
        $this->assertArrayHasKey('id', $createdSeed);
        $this->assertNotNull($createdSeed['id'], 'Created Seed must have id specified');
        $this->assertNotNull(Seed::find($createdSeed['id']), 'Seed with given id must be in DB');
        $this->assertModelData($seed, $createdSeed);
    }

    /**
     * @test read
     */
    public function test_read_seed()
    {
        $seed = $this->makeSeed();
        $dbSeed = $this->seedRepo->find($seed->id);
        $dbSeed = $dbSeed->toArray();
        $this->assertModelData($seed->toArray(), $dbSeed);
    }

    /**
     * @test update
     */
    public function test_update_seed()
    {
        $seed = $this->makeSeed();
        $fakeSeed = $this->fakeSeedData();
        $updatedSeed = $this->seedRepo->update($fakeSeed, $seed->id);
        $this->assertModelData($fakeSeed, $updatedSeed->toArray());
        $dbSeed = $this->seedRepo->find($seed->id);
        $this->assertModelData($fakeSeed, $dbSeed->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_seed()
    {
        $seed = $this->makeSeed();
        $resp = $this->seedRepo->delete($seed->id);
        $this->assertTrue($resp);
        $this->assertNull(Seed::find($seed->id), 'Seed should not exist in DB');
    }
}
