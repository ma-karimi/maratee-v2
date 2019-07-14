<?php namespace Tests\Repositories;

use App\Models\MedicinalPlantConstituent;
use App\Repositories\MedicinalPlantConstituentRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeMedicinalPlantConstituentTrait;
use Tests\ApiTestTrait;

class MedicinalPlantConstituentRepositoryTest extends TestCase
{
    use MakeMedicinalPlantConstituentTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var MedicinalPlantConstituentRepository
     */
    protected $medicinalPlantConstituentRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->medicinalPlantConstituentRepo = \App::make(MedicinalPlantConstituentRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_medicinal_plant_constituent()
    {
        $medicinalPlantConstituent = $this->fakeMedicinalPlantConstituentData();
        $createdMedicinalPlantConstituent = $this->medicinalPlantConstituentRepo->create($medicinalPlantConstituent);
        $createdMedicinalPlantConstituent = $createdMedicinalPlantConstituent->toArray();
        $this->assertArrayHasKey('id', $createdMedicinalPlantConstituent);
        $this->assertNotNull($createdMedicinalPlantConstituent['id'], 'Created MedicinalPlantConstituent must have id specified');
        $this->assertNotNull(MedicinalPlantConstituent::find($createdMedicinalPlantConstituent['id']), 'MedicinalPlantConstituent with given id must be in DB');
        $this->assertModelData($medicinalPlantConstituent, $createdMedicinalPlantConstituent);
    }

    /**
     * @test read
     */
    public function test_read_medicinal_plant_constituent()
    {
        $medicinalPlantConstituent = $this->makeMedicinalPlantConstituent();
        $dbMedicinalPlantConstituent = $this->medicinalPlantConstituentRepo->find($medicinalPlantConstituent->id);
        $dbMedicinalPlantConstituent = $dbMedicinalPlantConstituent->toArray();
        $this->assertModelData($medicinalPlantConstituent->toArray(), $dbMedicinalPlantConstituent);
    }

    /**
     * @test update
     */
    public function test_update_medicinal_plant_constituent()
    {
        $medicinalPlantConstituent = $this->makeMedicinalPlantConstituent();
        $fakeMedicinalPlantConstituent = $this->fakeMedicinalPlantConstituentData();
        $updatedMedicinalPlantConstituent = $this->medicinalPlantConstituentRepo->update($fakeMedicinalPlantConstituent, $medicinalPlantConstituent->id);
        $this->assertModelData($fakeMedicinalPlantConstituent, $updatedMedicinalPlantConstituent->toArray());
        $dbMedicinalPlantConstituent = $this->medicinalPlantConstituentRepo->find($medicinalPlantConstituent->id);
        $this->assertModelData($fakeMedicinalPlantConstituent, $dbMedicinalPlantConstituent->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_medicinal_plant_constituent()
    {
        $medicinalPlantConstituent = $this->makeMedicinalPlantConstituent();
        $resp = $this->medicinalPlantConstituentRepo->delete($medicinalPlantConstituent->id);
        $this->assertTrue($resp);
        $this->assertNull(MedicinalPlantConstituent::find($medicinalPlantConstituent->id), 'MedicinalPlantConstituent should not exist in DB');
    }
}
