<?php namespace Tests\Repositories;

use App\Models\MedicinalPlantMorphology;
use App\Repositories\MedicinalPlantMorphologyRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeMedicinalPlantMorphologyTrait;
use Tests\ApiTestTrait;

class MedicinalPlantMorphologyRepositoryTest extends TestCase
{
    use MakeMedicinalPlantMorphologyTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var MedicinalPlantMorphologyRepository
     */
    protected $medicinalPlantMorphologyRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->medicinalPlantMorphologyRepo = \App::make(MedicinalPlantMorphologyRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_medicinal_plant_morphology()
    {
        $medicinalPlantMorphology = $this->fakeMedicinalPlantMorphologyData();
        $createdMedicinalPlantMorphology = $this->medicinalPlantMorphologyRepo->create($medicinalPlantMorphology);
        $createdMedicinalPlantMorphology = $createdMedicinalPlantMorphology->toArray();
        $this->assertArrayHasKey('id', $createdMedicinalPlantMorphology);
        $this->assertNotNull($createdMedicinalPlantMorphology['id'], 'Created MedicinalPlantMorphology must have id specified');
        $this->assertNotNull(MedicinalPlantMorphology::find($createdMedicinalPlantMorphology['id']), 'MedicinalPlantMorphology with given id must be in DB');
        $this->assertModelData($medicinalPlantMorphology, $createdMedicinalPlantMorphology);
    }

    /**
     * @test read
     */
    public function test_read_medicinal_plant_morphology()
    {
        $medicinalPlantMorphology = $this->makeMedicinalPlantMorphology();
        $dbMedicinalPlantMorphology = $this->medicinalPlantMorphologyRepo->find($medicinalPlantMorphology->id);
        $dbMedicinalPlantMorphology = $dbMedicinalPlantMorphology->toArray();
        $this->assertModelData($medicinalPlantMorphology->toArray(), $dbMedicinalPlantMorphology);
    }

    /**
     * @test update
     */
    public function test_update_medicinal_plant_morphology()
    {
        $medicinalPlantMorphology = $this->makeMedicinalPlantMorphology();
        $fakeMedicinalPlantMorphology = $this->fakeMedicinalPlantMorphologyData();
        $updatedMedicinalPlantMorphology = $this->medicinalPlantMorphologyRepo->update($fakeMedicinalPlantMorphology, $medicinalPlantMorphology->id);
        $this->assertModelData($fakeMedicinalPlantMorphology, $updatedMedicinalPlantMorphology->toArray());
        $dbMedicinalPlantMorphology = $this->medicinalPlantMorphologyRepo->find($medicinalPlantMorphology->id);
        $this->assertModelData($fakeMedicinalPlantMorphology, $dbMedicinalPlantMorphology->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_medicinal_plant_morphology()
    {
        $medicinalPlantMorphology = $this->makeMedicinalPlantMorphology();
        $resp = $this->medicinalPlantMorphologyRepo->delete($medicinalPlantMorphology->id);
        $this->assertTrue($resp);
        $this->assertNull(MedicinalPlantMorphology::find($medicinalPlantMorphology->id), 'MedicinalPlantMorphology should not exist in DB');
    }
}
