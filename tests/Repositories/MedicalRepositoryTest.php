<?php namespace Tests\Repositories;

use App\Models\Medical;
use App\Repositories\MedicalRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeMedicalTrait;
use Tests\ApiTestTrait;

class MedicalRepositoryTest extends TestCase
{
    use MakeMedicalTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var MedicalRepository
     */
    protected $medicalRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->medicalRepo = \App::make(MedicalRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_medical()
    {
        $medical = $this->fakeMedicalData();
        $createdMedical = $this->medicalRepo->create($medical);
        $createdMedical = $createdMedical->toArray();
        $this->assertArrayHasKey('id', $createdMedical);
        $this->assertNotNull($createdMedical['id'], 'Created Medical must have id specified');
        $this->assertNotNull(Medical::find($createdMedical['id']), 'Medical with given id must be in DB');
        $this->assertModelData($medical, $createdMedical);
    }

    /**
     * @test read
     */
    public function test_read_medical()
    {
        $medical = $this->makeMedical();
        $dbMedical = $this->medicalRepo->find($medical->id);
        $dbMedical = $dbMedical->toArray();
        $this->assertModelData($medical->toArray(), $dbMedical);
    }

    /**
     * @test update
     */
    public function test_update_medical()
    {
        $medical = $this->makeMedical();
        $fakeMedical = $this->fakeMedicalData();
        $updatedMedical = $this->medicalRepo->update($fakeMedical, $medical->id);
        $this->assertModelData($fakeMedical, $updatedMedical->toArray());
        $dbMedical = $this->medicalRepo->find($medical->id);
        $this->assertModelData($fakeMedical, $dbMedical->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_medical()
    {
        $medical = $this->makeMedical();
        $resp = $this->medicalRepo->delete($medical->id);
        $this->assertTrue($resp);
        $this->assertNull(Medical::find($medical->id), 'Medical should not exist in DB');
    }
}
