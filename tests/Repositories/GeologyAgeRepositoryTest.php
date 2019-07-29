<?php namespace Tests\Repositories;

use App\Models\GeologyAge;
use App\Repositories\GeologyAgeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeGeologyAgeTrait;
use Tests\ApiTestTrait;

class GeologyAgeRepositoryTest extends TestCase
{
    use MakeGeologyAgeTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var GeologyAgeRepository
     */
    protected $geologyAgeRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->geologyAgeRepo = \App::make(GeologyAgeRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_geology_age()
    {
        $geologyAge = $this->fakeGeologyAgeData();
        $createdGeologyAge = $this->geologyAgeRepo->create($geologyAge);
        $createdGeologyAge = $createdGeologyAge->toArray();
        $this->assertArrayHasKey('id', $createdGeologyAge);
        $this->assertNotNull($createdGeologyAge['id'], 'Created GeologyAge must have id specified');
        $this->assertNotNull(GeologyAge::find($createdGeologyAge['id']), 'GeologyAge with given id must be in DB');
        $this->assertModelData($geologyAge, $createdGeologyAge);
    }

    /**
     * @test read
     */
    public function test_read_geology_age()
    {
        $geologyAge = $this->makeGeologyAge();
        $dbGeologyAge = $this->geologyAgeRepo->find($geologyAge->id);
        $dbGeologyAge = $dbGeologyAge->toArray();
        $this->assertModelData($geologyAge->toArray(), $dbGeologyAge);
    }

    /**
     * @test update
     */
    public function test_update_geology_age()
    {
        $geologyAge = $this->makeGeologyAge();
        $fakeGeologyAge = $this->fakeGeologyAgeData();
        $updatedGeologyAge = $this->geologyAgeRepo->update($fakeGeologyAge, $geologyAge->id);
        $this->assertModelData($fakeGeologyAge, $updatedGeologyAge->toArray());
        $dbGeologyAge = $this->geologyAgeRepo->find($geologyAge->id);
        $this->assertModelData($fakeGeologyAge, $dbGeologyAge->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_geology_age()
    {
        $geologyAge = $this->makeGeologyAge();
        $resp = $this->geologyAgeRepo->delete($geologyAge->id);
        $this->assertTrue($resp);
        $this->assertNull(GeologyAge::find($geologyAge->id), 'GeologyAge should not exist in DB');
    }
}
