<?php namespace Tests\Repositories;

use App\Models\Map;
use App\Repositories\MapRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeMapTrait;
use Tests\ApiTestTrait;

class MapRepositoryTest extends TestCase
{
    use MakeMapTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var MapRepository
     */
    protected $mapRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->mapRepo = \App::make(MapRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_map()
    {
        $map = $this->fakeMapData();
        $createdMap = $this->mapRepo->create($map);
        $createdMap = $createdMap->toArray();
        $this->assertArrayHasKey('id', $createdMap);
        $this->assertNotNull($createdMap['id'], 'Created Map must have id specified');
        $this->assertNotNull(Map::find($createdMap['id']), 'Map with given id must be in DB');
        $this->assertModelData($map, $createdMap);
    }

    /**
     * @test read
     */
    public function test_read_map()
    {
        $map = $this->makeMap();
        $dbMap = $this->mapRepo->find($map->id);
        $dbMap = $dbMap->toArray();
        $this->assertModelData($map->toArray(), $dbMap);
    }

    /**
     * @test update
     */
    public function test_update_map()
    {
        $map = $this->makeMap();
        $fakeMap = $this->fakeMapData();
        $updatedMap = $this->mapRepo->update($fakeMap, $map->id);
        $this->assertModelData($fakeMap, $updatedMap->toArray());
        $dbMap = $this->mapRepo->find($map->id);
        $this->assertModelData($fakeMap, $dbMap->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_map()
    {
        $map = $this->makeMap();
        $resp = $this->mapRepo->delete($map->id);
        $this->assertTrue($resp);
        $this->assertNull(Map::find($map->id), 'Map should not exist in DB');
    }
}
