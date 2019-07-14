<?php namespace Tests\Repositories;

use App\Models\CryoBank;
use App\Repositories\CryoBankRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeCryoBankTrait;
use Tests\ApiTestTrait;

class CryoBankRepositoryTest extends TestCase
{
    use MakeCryoBankTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var CryoBankRepository
     */
    protected $cryoBankRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->cryoBankRepo = \App::make(CryoBankRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_cryo_bank()
    {
        $cryoBank = $this->fakeCryoBankData();
        $createdCryoBank = $this->cryoBankRepo->create($cryoBank);
        $createdCryoBank = $createdCryoBank->toArray();
        $this->assertArrayHasKey('id', $createdCryoBank);
        $this->assertNotNull($createdCryoBank['id'], 'Created CryoBank must have id specified');
        $this->assertNotNull(CryoBank::find($createdCryoBank['id']), 'CryoBank with given id must be in DB');
        $this->assertModelData($cryoBank, $createdCryoBank);
    }

    /**
     * @test read
     */
    public function test_read_cryo_bank()
    {
        $cryoBank = $this->makeCryoBank();
        $dbCryoBank = $this->cryoBankRepo->find($cryoBank->id);
        $dbCryoBank = $dbCryoBank->toArray();
        $this->assertModelData($cryoBank->toArray(), $dbCryoBank);
    }

    /**
     * @test update
     */
    public function test_update_cryo_bank()
    {
        $cryoBank = $this->makeCryoBank();
        $fakeCryoBank = $this->fakeCryoBankData();
        $updatedCryoBank = $this->cryoBankRepo->update($fakeCryoBank, $cryoBank->id);
        $this->assertModelData($fakeCryoBank, $updatedCryoBank->toArray());
        $dbCryoBank = $this->cryoBankRepo->find($cryoBank->id);
        $this->assertModelData($fakeCryoBank, $dbCryoBank->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_cryo_bank()
    {
        $cryoBank = $this->makeCryoBank();
        $resp = $this->cryoBankRepo->delete($cryoBank->id);
        $this->assertTrue($resp);
        $this->assertNull(CryoBank::find($cryoBank->id), 'CryoBank should not exist in DB');
    }
}
