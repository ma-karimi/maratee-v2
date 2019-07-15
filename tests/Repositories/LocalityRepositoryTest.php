<?php namespace Tests\Repositories;

use App\Models\Locality;
use App\Repositories\LocalityRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeLocalityTrait;
use Tests\ApiTestTrait;

class LocalityRepositoryTest extends TestCase
{
    use MakeLocalityTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var LocalityRepository
     */
    protected $localityRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->localityRepo = \App::make(LocalityRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_locality()
    {
        $locality = $this->fakeLocalityData();
        $createdLocality = $this->localityRepo->create($locality);
        $createdLocality = $createdLocality->toArray();
        $this->assertArrayHasKey('id', $createdLocality);
        $this->assertNotNull($createdLocality['id'], 'Created Locality must have id specified');
        $this->assertNotNull(Locality::find($createdLocality['id']), 'Locality with given id must be in DB');
        $this->assertModelData($locality, $createdLocality);
    }

    /**
     * @test read
     */
    public function test_read_locality()
    {
        $locality = $this->makeLocality();
        $dbLocality = $this->localityRepo->find($locality->id);
        $dbLocality = $dbLocality->toArray();
        $this->assertModelData($locality->toArray(), $dbLocality);
    }

    /**
     * @test update
     */
    public function test_update_locality()
    {
        $locality = $this->makeLocality();
        $fakeLocality = $this->fakeLocalityData();
        $updatedLocality = $this->localityRepo->update($fakeLocality, $locality->id);
        $this->assertModelData($fakeLocality, $updatedLocality->toArray());
        $dbLocality = $this->localityRepo->find($locality->id);
        $this->assertModelData($fakeLocality, $dbLocality->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_locality()
    {
        $locality = $this->makeLocality();
        $resp = $this->localityRepo->delete($locality->id);
        $this->assertTrue($resp);
        $this->assertNull(Locality::find($locality->id), 'Locality should not exist in DB');
    }
}
