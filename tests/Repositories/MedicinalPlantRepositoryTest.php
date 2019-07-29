<?php namespace Tests\Repositories;

use App\Models\MedicinalPlant;
use App\Repositories\MedicinalPlantRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeMedicinalPlantTrait;
use Tests\ApiTestTrait;

class MedicinalPlantRepositoryTest extends TestCase
{
    use MakeMedicinalPlantTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var MedicinalPlantRepository
     */
    protected $medicinalPlantRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->medicinalPlantRepo = \App::make(MedicinalPlantRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_medicinal_plant()
    {
        $medicinalPlant = $this->fakeMedicinalPlantData();
        $createdMedicinalPlant = $this->medicinalPlantRepo->create($medicinalPlant);
        $createdMedicinalPlant = $createdMedicinalPlant->toArray();
        $this->assertArrayHasKey('id', $createdMedicinalPlant);
        $this->assertNotNull($createdMedicinalPlant['id'], 'Created MedicinalPlant must have id specified');
        $this->assertNotNull(MedicinalPlant::find($createdMedicinalPlant['id']), 'MedicinalPlant with given id must be in DB');
        $this->assertModelData($medicinalPlant, $createdMedicinalPlant);
    }

    /**
     * @test read
     */
    public function test_read_medicinal_plant()
    {
        $medicinalPlant = $this->makeMedicinalPlant();
        $dbMedicinalPlant = $this->medicinalPlantRepo->find($medicinalPlant->id);
        $dbMedicinalPlant = $dbMedicinalPlant->toArray();
        $this->assertModelData($medicinalPlant->toArray(), $dbMedicinalPlant);
    }

    /**
     * @test update
     */
    public function test_update_medicinal_plant()
    {
        $medicinalPlant = $this->makeMedicinalPlant();
        $fakeMedicinalPlant = $this->fakeMedicinalPlantData();
        $updatedMedicinalPlant = $this->medicinalPlantRepo->update($fakeMedicinalPlant, $medicinalPlant->id);
        $this->assertModelData($fakeMedicinalPlant, $updatedMedicinalPlant->toArray());
        $dbMedicinalPlant = $this->medicinalPlantRepo->find($medicinalPlant->id);
        $this->assertModelData($fakeMedicinalPlant, $dbMedicinalPlant->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_medicinal_plant()
    {
        $medicinalPlant = $this->makeMedicinalPlant();
        $resp = $this->medicinalPlantRepo->delete($medicinalPlant->id);
        $this->assertTrue($resp);
        $this->assertNull(MedicinalPlant::find($medicinalPlant->id), 'MedicinalPlant should not exist in DB');
    }
}
