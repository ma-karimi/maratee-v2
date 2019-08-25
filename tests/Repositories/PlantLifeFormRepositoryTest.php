<?php namespace Tests\Repositories;

use App\Models\PlantLifeForm;
use App\Repositories\PlantLifeFormRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class PlantLifeFormRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var PlantLifeFormRepository
     */
    protected $plantLifeFormRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->plantLifeFormRepo = \App::make(PlantLifeFormRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_plant_life_form()
    {
        $plantLifeForm = factory(PlantLifeForm::class)->make()->toArray();

        $createdPlantLifeForm = $this->plantLifeFormRepo->create($plantLifeForm);

        $createdPlantLifeForm = $createdPlantLifeForm->toArray();
        $this->assertArrayHasKey('id', $createdPlantLifeForm);
        $this->assertNotNull($createdPlantLifeForm['id'], 'Created PlantLifeForm must have id specified');
        $this->assertNotNull(PlantLifeForm::find($createdPlantLifeForm['id']), 'PlantLifeForm with given id must be in DB');
        $this->assertModelData($plantLifeForm, $createdPlantLifeForm);
    }

    /**
     * @test read
     */
    public function test_read_plant_life_form()
    {
        $plantLifeForm = factory(PlantLifeForm::class)->create();

        $dbPlantLifeForm = $this->plantLifeFormRepo->find($plantLifeForm->id);

        $dbPlantLifeForm = $dbPlantLifeForm->toArray();
        $this->assertModelData($plantLifeForm->toArray(), $dbPlantLifeForm);
    }

    /**
     * @test update
     */
    public function test_update_plant_life_form()
    {
        $plantLifeForm = factory(PlantLifeForm::class)->create();
        $fakePlantLifeForm = factory(PlantLifeForm::class)->make()->toArray();

        $updatedPlantLifeForm = $this->plantLifeFormRepo->update($fakePlantLifeForm, $plantLifeForm->id);

        $this->assertModelData($fakePlantLifeForm, $updatedPlantLifeForm->toArray());
        $dbPlantLifeForm = $this->plantLifeFormRepo->find($plantLifeForm->id);
        $this->assertModelData($fakePlantLifeForm, $dbPlantLifeForm->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_plant_life_form()
    {
        $plantLifeForm = factory(PlantLifeForm::class)->create();

        $resp = $this->plantLifeFormRepo->delete($plantLifeForm->id);

        $this->assertTrue($resp);
        $this->assertNull(PlantLifeForm::find($plantLifeForm->id), 'PlantLifeForm should not exist in DB');
    }
}
