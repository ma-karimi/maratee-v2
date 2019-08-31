<?php namespace Tests\Repositories;

use App\Models\MedicinalPlantType;
use App\Repositories\MedicinalPlantTypeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class MedicinalPlantTypeRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var MedicinalPlantTypeRepository
     */
    protected $medicinalPlantTypeRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->medicinalPlantTypeRepo = \App::make(MedicinalPlantTypeRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_medicinal_plant_type()
    {
        $medicinalPlantType = factory(MedicinalPlantType::class)->make()->toArray();

        $createdMedicinalPlantType = $this->medicinalPlantTypeRepo->create($medicinalPlantType);

        $createdMedicinalPlantType = $createdMedicinalPlantType->toArray();
        $this->assertArrayHasKey('id', $createdMedicinalPlantType);
        $this->assertNotNull($createdMedicinalPlantType['id'], 'Created MedicinalPlantType must have id specified');
        $this->assertNotNull(MedicinalPlantType::find($createdMedicinalPlantType['id']), 'MedicinalPlantType with given id must be in DB');
        $this->assertModelData($medicinalPlantType, $createdMedicinalPlantType);
    }

    /**
     * @test read
     */
    public function test_read_medicinal_plant_type()
    {
        $medicinalPlantType = factory(MedicinalPlantType::class)->create();

        $dbMedicinalPlantType = $this->medicinalPlantTypeRepo->find($medicinalPlantType->id);

        $dbMedicinalPlantType = $dbMedicinalPlantType->toArray();
        $this->assertModelData($medicinalPlantType->toArray(), $dbMedicinalPlantType);
    }

    /**
     * @test update
     */
    public function test_update_medicinal_plant_type()
    {
        $medicinalPlantType = factory(MedicinalPlantType::class)->create();
        $fakeMedicinalPlantType = factory(MedicinalPlantType::class)->make()->toArray();

        $updatedMedicinalPlantType = $this->medicinalPlantTypeRepo->update($fakeMedicinalPlantType, $medicinalPlantType->id);

        $this->assertModelData($fakeMedicinalPlantType, $updatedMedicinalPlantType->toArray());
        $dbMedicinalPlantType = $this->medicinalPlantTypeRepo->find($medicinalPlantType->id);
        $this->assertModelData($fakeMedicinalPlantType, $dbMedicinalPlantType->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_medicinal_plant_type()
    {
        $medicinalPlantType = factory(MedicinalPlantType::class)->create();

        $resp = $this->medicinalPlantTypeRepo->delete($medicinalPlantType->id);

        $this->assertTrue($resp);
        $this->assertNull(MedicinalPlantType::find($medicinalPlantType->id), 'MedicinalPlantType should not exist in DB');
    }
}
