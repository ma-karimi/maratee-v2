<?php namespace Tests\Repositories;

use App\Models\SeedCollection;
use App\Repositories\SeedCollectionRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class SeedCollectionRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var SeedCollectionRepository
     */
    protected $seedCollectionRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->seedCollectionRepo = \App::make(SeedCollectionRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_seed_collection()
    {
        $seedCollection = factory(SeedCollection::class)->make()->toArray();

        $createdSeedCollection = $this->seedCollectionRepo->create($seedCollection);

        $createdSeedCollection = $createdSeedCollection->toArray();
        $this->assertArrayHasKey('id', $createdSeedCollection);
        $this->assertNotNull($createdSeedCollection['id'], 'Created SeedCollection must have id specified');
        $this->assertNotNull(SeedCollection::find($createdSeedCollection['id']), 'SeedCollection with given id must be in DB');
        $this->assertModelData($seedCollection, $createdSeedCollection);
    }

    /**
     * @test read
     */
    public function test_read_seed_collection()
    {
        $seedCollection = factory(SeedCollection::class)->create();

        $dbSeedCollection = $this->seedCollectionRepo->find($seedCollection->id);

        $dbSeedCollection = $dbSeedCollection->toArray();
        $this->assertModelData($seedCollection->toArray(), $dbSeedCollection);
    }

    /**
     * @test update
     */
    public function test_update_seed_collection()
    {
        $seedCollection = factory(SeedCollection::class)->create();
        $fakeSeedCollection = factory(SeedCollection::class)->make()->toArray();

        $updatedSeedCollection = $this->seedCollectionRepo->update($fakeSeedCollection, $seedCollection->id);

        $this->assertModelData($fakeSeedCollection, $updatedSeedCollection->toArray());
        $dbSeedCollection = $this->seedCollectionRepo->find($seedCollection->id);
        $this->assertModelData($fakeSeedCollection, $dbSeedCollection->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_seed_collection()
    {
        $seedCollection = factory(SeedCollection::class)->create();

        $resp = $this->seedCollectionRepo->delete($seedCollection->id);

        $this->assertTrue($resp);
        $this->assertNull(SeedCollection::find($seedCollection->id), 'SeedCollection should not exist in DB');
    }
}
