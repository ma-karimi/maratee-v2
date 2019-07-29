<?php namespace Tests\Repositories;

use App\Models\Collection;
use App\Repositories\CollectionRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeCollectionTrait;
use Tests\ApiTestTrait;

class CollectionRepositoryTest extends TestCase
{
    use MakeCollectionTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var CollectionRepository
     */
    protected $collectionRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->collectionRepo = \App::make(CollectionRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_collection()
    {
        $collection = $this->fakeCollectionData();
        $createdCollection = $this->collectionRepo->create($collection);
        $createdCollection = $createdCollection->toArray();
        $this->assertArrayHasKey('id', $createdCollection);
        $this->assertNotNull($createdCollection['id'], 'Created Collection must have id specified');
        $this->assertNotNull(Collection::find($createdCollection['id']), 'Collection with given id must be in DB');
        $this->assertModelData($collection, $createdCollection);
    }

    /**
     * @test read
     */
    public function test_read_collection()
    {
        $collection = $this->makeCollection();
        $dbCollection = $this->collectionRepo->find($collection->id);
        $dbCollection = $dbCollection->toArray();
        $this->assertModelData($collection->toArray(), $dbCollection);
    }

    /**
     * @test update
     */
    public function test_update_collection()
    {
        $collection = $this->makeCollection();
        $fakeCollection = $this->fakeCollectionData();
        $updatedCollection = $this->collectionRepo->update($fakeCollection, $collection->id);
        $this->assertModelData($fakeCollection, $updatedCollection->toArray());
        $dbCollection = $this->collectionRepo->find($collection->id);
        $this->assertModelData($fakeCollection, $dbCollection->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_collection()
    {
        $collection = $this->makeCollection();
        $resp = $this->collectionRepo->delete($collection->id);
        $this->assertTrue($resp);
        $this->assertNull(Collection::find($collection->id), 'Collection should not exist in DB');
    }
}
