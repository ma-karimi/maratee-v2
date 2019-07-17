<?php namespace Tests\Repositories;

use App\Models\Chemical;
use App\Repositories\ChemicalRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeChemicalTrait;
use Tests\ApiTestTrait;

class ChemicalRepositoryTest extends TestCase
{
    use MakeChemicalTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ChemicalRepository
     */
    protected $chemicalRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->chemicalRepo = \App::make(ChemicalRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_chemical()
    {
        $chemical = $this->fakeChemicalData();
        $createdChemical = $this->chemicalRepo->create($chemical);
        $createdChemical = $createdChemical->toArray();
        $this->assertArrayHasKey('id', $createdChemical);
        $this->assertNotNull($createdChemical['id'], 'Created Chemical must have id specified');
        $this->assertNotNull(Chemical::find($createdChemical['id']), 'Chemical with given id must be in DB');
        $this->assertModelData($chemical, $createdChemical);
    }

    /**
     * @test read
     */
    public function test_read_chemical()
    {
        $chemical = $this->makeChemical();
        $dbChemical = $this->chemicalRepo->find($chemical->id);
        $dbChemical = $dbChemical->toArray();
        $this->assertModelData($chemical->toArray(), $dbChemical);
    }

    /**
     * @test update
     */
    public function test_update_chemical()
    {
        $chemical = $this->makeChemical();
        $fakeChemical = $this->fakeChemicalData();
        $updatedChemical = $this->chemicalRepo->update($fakeChemical, $chemical->id);
        $this->assertModelData($fakeChemical, $updatedChemical->toArray());
        $dbChemical = $this->chemicalRepo->find($chemical->id);
        $this->assertModelData($fakeChemical, $dbChemical->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_chemical()
    {
        $chemical = $this->makeChemical();
        $resp = $this->chemicalRepo->delete($chemical->id);
        $this->assertTrue($resp);
        $this->assertNull(Chemical::find($chemical->id), 'Chemical should not exist in DB');
    }
}
