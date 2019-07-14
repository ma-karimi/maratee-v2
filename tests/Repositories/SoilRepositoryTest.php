<?php namespace Tests\Repositories;

use App\Models\Soil;
use App\Repositories\SoilRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeSoilTrait;
use Tests\ApiTestTrait;

class SoilRepositoryTest extends TestCase
{
    use MakeSoilTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var SoilRepository
     */
    protected $soilRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->soilRepo = \App::make(SoilRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_soil()
    {
        $soil = $this->fakeSoilData();
        $createdSoil = $this->soilRepo->create($soil);
        $createdSoil = $createdSoil->toArray();
        $this->assertArrayHasKey('id', $createdSoil);
        $this->assertNotNull($createdSoil['id'], 'Created Soil must have id specified');
        $this->assertNotNull(Soil::find($createdSoil['id']), 'Soil with given id must be in DB');
        $this->assertModelData($soil, $createdSoil);
    }

    /**
     * @test read
     */
    public function test_read_soil()
    {
        $soil = $this->makeSoil();
        $dbSoil = $this->soilRepo->find($soil->id);
        $dbSoil = $dbSoil->toArray();
        $this->assertModelData($soil->toArray(), $dbSoil);
    }

    /**
     * @test update
     */
    public function test_update_soil()
    {
        $soil = $this->makeSoil();
        $fakeSoil = $this->fakeSoilData();
        $updatedSoil = $this->soilRepo->update($fakeSoil, $soil->id);
        $this->assertModelData($fakeSoil, $updatedSoil->toArray());
        $dbSoil = $this->soilRepo->find($soil->id);
        $this->assertModelData($fakeSoil, $dbSoil->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_soil()
    {
        $soil = $this->makeSoil();
        $resp = $this->soilRepo->delete($soil->id);
        $this->assertTrue($resp);
        $this->assertNull(Soil::find($soil->id), 'Soil should not exist in DB');
    }
}
