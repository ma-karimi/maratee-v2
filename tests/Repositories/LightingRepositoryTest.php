<?php namespace Tests\Repositories;

use App\Models\Lighting;
use App\Repositories\LightingRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeLightingTrait;
use Tests\ApiTestTrait;

class LightingRepositoryTest extends TestCase
{
    use MakeLightingTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var LightingRepository
     */
    protected $lightingRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->lightingRepo = \App::make(LightingRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_lighting()
    {
        $lighting = $this->fakeLightingData();
        $createdLighting = $this->lightingRepo->create($lighting);
        $createdLighting = $createdLighting->toArray();
        $this->assertArrayHasKey('id', $createdLighting);
        $this->assertNotNull($createdLighting['id'], 'Created Lighting must have id specified');
        $this->assertNotNull(Lighting::find($createdLighting['id']), 'Lighting with given id must be in DB');
        $this->assertModelData($lighting, $createdLighting);
    }

    /**
     * @test read
     */
    public function test_read_lighting()
    {
        $lighting = $this->makeLighting();
        $dbLighting = $this->lightingRepo->find($lighting->id);
        $dbLighting = $dbLighting->toArray();
        $this->assertModelData($lighting->toArray(), $dbLighting);
    }

    /**
     * @test update
     */
    public function test_update_lighting()
    {
        $lighting = $this->makeLighting();
        $fakeLighting = $this->fakeLightingData();
        $updatedLighting = $this->lightingRepo->update($fakeLighting, $lighting->id);
        $this->assertModelData($fakeLighting, $updatedLighting->toArray());
        $dbLighting = $this->lightingRepo->find($lighting->id);
        $this->assertModelData($fakeLighting, $dbLighting->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_lighting()
    {
        $lighting = $this->makeLighting();
        $resp = $this->lightingRepo->delete($lighting->id);
        $this->assertTrue($resp);
        $this->assertNull(Lighting::find($lighting->id), 'Lighting should not exist in DB');
    }
}
