<?php namespace Tests\Repositories;

use App\Models\MedicinalPart;
use App\Repositories\MedicinalPartRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class MedicinalPartRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var MedicinalPartRepository
     */
    protected $medicinalPartRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->medicinalPartRepo = \App::make(MedicinalPartRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_medicinal_part()
    {
        $medicinalPart = factory(MedicinalPart::class)->make()->toArray();

        $createdMedicinalPart = $this->medicinalPartRepo->create($medicinalPart);

        $createdMedicinalPart = $createdMedicinalPart->toArray();
        $this->assertArrayHasKey('id', $createdMedicinalPart);
        $this->assertNotNull($createdMedicinalPart['id'], 'Created MedicinalPart must have id specified');
        $this->assertNotNull(MedicinalPart::find($createdMedicinalPart['id']), 'MedicinalPart with given id must be in DB');
        $this->assertModelData($medicinalPart, $createdMedicinalPart);
    }

    /**
     * @test read
     */
    public function test_read_medicinal_part()
    {
        $medicinalPart = factory(MedicinalPart::class)->create();

        $dbMedicinalPart = $this->medicinalPartRepo->find($medicinalPart->id);

        $dbMedicinalPart = $dbMedicinalPart->toArray();
        $this->assertModelData($medicinalPart->toArray(), $dbMedicinalPart);
    }

    /**
     * @test update
     */
    public function test_update_medicinal_part()
    {
        $medicinalPart = factory(MedicinalPart::class)->create();
        $fakeMedicinalPart = factory(MedicinalPart::class)->make()->toArray();

        $updatedMedicinalPart = $this->medicinalPartRepo->update($fakeMedicinalPart, $medicinalPart->id);

        $this->assertModelData($fakeMedicinalPart, $updatedMedicinalPart->toArray());
        $dbMedicinalPart = $this->medicinalPartRepo->find($medicinalPart->id);
        $this->assertModelData($fakeMedicinalPart, $dbMedicinalPart->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_medicinal_part()
    {
        $medicinalPart = factory(MedicinalPart::class)->create();

        $resp = $this->medicinalPartRepo->delete($medicinalPart->id);

        $this->assertTrue($resp);
        $this->assertNull(MedicinalPart::find($medicinalPart->id), 'MedicinalPart should not exist in DB');
    }
}
