<?php namespace Tests\Repositories;

use App\Models\Continent;
use App\Repositories\ContinentRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeContinentTrait;
use Tests\ApiTestTrait;

class ContinentRepositoryTest extends TestCase
{
    use MakeContinentTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ContinentRepository
     */
    protected $continentRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->continentRepo = \App::make(ContinentRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_continent()
    {
        $continent = $this->fakeContinentData();
        $createdContinent = $this->continentRepo->create($continent);
        $createdContinent = $createdContinent->toArray();
        $this->assertArrayHasKey('id', $createdContinent);
        $this->assertNotNull($createdContinent['id'], 'Created Continent must have id specified');
        $this->assertNotNull(Continent::find($createdContinent['id']), 'Continent with given id must be in DB');
        $this->assertModelData($continent, $createdContinent);
    }

    /**
     * @test read
     */
    public function test_read_continent()
    {
        $continent = $this->makeContinent();
        $dbContinent = $this->continentRepo->find($continent->id);
        $dbContinent = $dbContinent->toArray();
        $this->assertModelData($continent->toArray(), $dbContinent);
    }

    /**
     * @test update
     */
    public function test_update_continent()
    {
        $continent = $this->makeContinent();
        $fakeContinent = $this->fakeContinentData();
        $updatedContinent = $this->continentRepo->update($fakeContinent, $continent->id);
        $this->assertModelData($fakeContinent, $updatedContinent->toArray());
        $dbContinent = $this->continentRepo->find($continent->id);
        $this->assertModelData($fakeContinent, $dbContinent->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_continent()
    {
        $continent = $this->makeContinent();
        $resp = $this->continentRepo->delete($continent->id);
        $this->assertTrue($resp);
        $this->assertNull(Continent::find($continent->id), 'Continent should not exist in DB');
    }
}
