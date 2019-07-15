<?php namespace Tests\Repositories;

use App\Models\Credential;
use App\Repositories\CredentialRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeCredentialTrait;
use Tests\ApiTestTrait;

class CredentialRepositoryTest extends TestCase
{
    use MakeCredentialTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var CredentialRepository
     */
    protected $credentialRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->credentialRepo = \App::make(CredentialRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_credential()
    {
        $credential = $this->fakeCredentialData();
        $createdCredential = $this->credentialRepo->create($credential);
        $createdCredential = $createdCredential->toArray();
        $this->assertArrayHasKey('id', $createdCredential);
        $this->assertNotNull($createdCredential['id'], 'Created Credential must have id specified');
        $this->assertNotNull(Credential::find($createdCredential['id']), 'Credential with given id must be in DB');
        $this->assertModelData($credential, $createdCredential);
    }

    /**
     * @test read
     */
    public function test_read_credential()
    {
        $credential = $this->makeCredential();
        $dbCredential = $this->credentialRepo->find($credential->id);
        $dbCredential = $dbCredential->toArray();
        $this->assertModelData($credential->toArray(), $dbCredential);
    }

    /**
     * @test update
     */
    public function test_update_credential()
    {
        $credential = $this->makeCredential();
        $fakeCredential = $this->fakeCredentialData();
        $updatedCredential = $this->credentialRepo->update($fakeCredential, $credential->id);
        $this->assertModelData($fakeCredential, $updatedCredential->toArray());
        $dbCredential = $this->credentialRepo->find($credential->id);
        $this->assertModelData($fakeCredential, $dbCredential->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_credential()
    {
        $credential = $this->makeCredential();
        $resp = $this->credentialRepo->delete($credential->id);
        $this->assertTrue($resp);
        $this->assertNull(Credential::find($credential->id), 'Credential should not exist in DB');
    }
}
