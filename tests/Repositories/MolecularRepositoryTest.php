<?php namespace Tests\Repositories;

use App\Models\Molecular;
use App\Repositories\MolecularRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeMolecularTrait;
use Tests\ApiTestTrait;

class MolecularRepositoryTest extends TestCase
{
    use MakeMolecularTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var MolecularRepository
     */
    protected $molecularRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->molecularRepo = \App::make(MolecularRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_molecular()
    {
        $molecular = $this->fakeMolecularData();
        $createdMolecular = $this->molecularRepo->create($molecular);
        $createdMolecular = $createdMolecular->toArray();
        $this->assertArrayHasKey('id', $createdMolecular);
        $this->assertNotNull($createdMolecular['id'], 'Created Molecular must have id specified');
        $this->assertNotNull(Molecular::find($createdMolecular['id']), 'Molecular with given id must be in DB');
        $this->assertModelData($molecular, $createdMolecular);
    }

    /**
     * @test read
     */
    public function test_read_molecular()
    {
        $molecular = $this->makeMolecular();
        $dbMolecular = $this->molecularRepo->find($molecular->id);
        $dbMolecular = $dbMolecular->toArray();
        $this->assertModelData($molecular->toArray(), $dbMolecular);
    }

    /**
     * @test update
     */
    public function test_update_molecular()
    {
        $molecular = $this->makeMolecular();
        $fakeMolecular = $this->fakeMolecularData();
        $updatedMolecular = $this->molecularRepo->update($fakeMolecular, $molecular->id);
        $this->assertModelData($fakeMolecular, $updatedMolecular->toArray());
        $dbMolecular = $this->molecularRepo->find($molecular->id);
        $this->assertModelData($fakeMolecular, $dbMolecular->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_molecular()
    {
        $molecular = $this->makeMolecular();
        $resp = $this->molecularRepo->delete($molecular->id);
        $this->assertTrue($resp);
        $this->assertNull(Molecular::find($molecular->id), 'Molecular should not exist in DB');
    }
}
