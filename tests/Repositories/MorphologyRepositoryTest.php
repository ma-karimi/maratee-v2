<?php namespace Tests\Repositories;

use App\Models\Morphology;
use App\Repositories\MorphologyRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeMorphologyTrait;
use Tests\ApiTestTrait;

class MorphologyRepositoryTest extends TestCase
{
    use MakeMorphologyTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var MorphologyRepository
     */
    protected $morphologyRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->morphologyRepo = \App::make(MorphologyRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_morphology()
    {
        $morphology = $this->fakeMorphologyData();
        $createdMorphology = $this->morphologyRepo->create($morphology);
        $createdMorphology = $createdMorphology->toArray();
        $this->assertArrayHasKey('id', $createdMorphology);
        $this->assertNotNull($createdMorphology['id'], 'Created Morphology must have id specified');
        $this->assertNotNull(Morphology::find($createdMorphology['id']), 'Morphology with given id must be in DB');
        $this->assertModelData($morphology, $createdMorphology);
    }

    /**
     * @test read
     */
    public function test_read_morphology()
    {
        $morphology = $this->makeMorphology();
        $dbMorphology = $this->morphologyRepo->find($morphology->id);
        $dbMorphology = $dbMorphology->toArray();
        $this->assertModelData($morphology->toArray(), $dbMorphology);
    }

    /**
     * @test update
     */
    public function test_update_morphology()
    {
        $morphology = $this->makeMorphology();
        $fakeMorphology = $this->fakeMorphologyData();
        $updatedMorphology = $this->morphologyRepo->update($fakeMorphology, $morphology->id);
        $this->assertModelData($fakeMorphology, $updatedMorphology->toArray());
        $dbMorphology = $this->morphologyRepo->find($morphology->id);
        $this->assertModelData($fakeMorphology, $dbMorphology->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_morphology()
    {
        $morphology = $this->makeMorphology();
        $resp = $this->morphologyRepo->delete($morphology->id);
        $this->assertTrue($resp);
        $this->assertNull(Morphology::find($morphology->id), 'Morphology should not exist in DB');
    }
}
