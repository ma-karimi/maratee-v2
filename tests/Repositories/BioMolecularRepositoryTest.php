<?php namespace Tests\Repositories;

use App\Models\BioMolecular;
use App\Repositories\BioMolecularRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeBioMolecularTrait;
use Tests\ApiTestTrait;

class BioMolecularRepositoryTest extends TestCase
{
    use MakeBioMolecularTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var BioMolecularRepository
     */
    protected $bioMolecularRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->bioMolecularRepo = \App::make(BioMolecularRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_bio_molecular()
    {
        $bioMolecular = $this->fakeBioMolecularData();
        $createdBioMolecular = $this->bioMolecularRepo->create($bioMolecular);
        $createdBioMolecular = $createdBioMolecular->toArray();
        $this->assertArrayHasKey('id', $createdBioMolecular);
        $this->assertNotNull($createdBioMolecular['id'], 'Created BioMolecular must have id specified');
        $this->assertNotNull(BioMolecular::find($createdBioMolecular['id']), 'BioMolecular with given id must be in DB');
        $this->assertModelData($bioMolecular, $createdBioMolecular);
    }

    /**
     * @test read
     */
    public function test_read_bio_molecular()
    {
        $bioMolecular = $this->makeBioMolecular();
        $dbBioMolecular = $this->bioMolecularRepo->find($bioMolecular->id);
        $dbBioMolecular = $dbBioMolecular->toArray();
        $this->assertModelData($bioMolecular->toArray(), $dbBioMolecular);
    }

    /**
     * @test update
     */
    public function test_update_bio_molecular()
    {
        $bioMolecular = $this->makeBioMolecular();
        $fakeBioMolecular = $this->fakeBioMolecularData();
        $updatedBioMolecular = $this->bioMolecularRepo->update($fakeBioMolecular, $bioMolecular->id);
        $this->assertModelData($fakeBioMolecular, $updatedBioMolecular->toArray());
        $dbBioMolecular = $this->bioMolecularRepo->find($bioMolecular->id);
        $this->assertModelData($fakeBioMolecular, $dbBioMolecular->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_bio_molecular()
    {
        $bioMolecular = $this->makeBioMolecular();
        $resp = $this->bioMolecularRepo->delete($bioMolecular->id);
        $this->assertTrue($resp);
        $this->assertNull(BioMolecular::find($bioMolecular->id), 'BioMolecular should not exist in DB');
    }
}
