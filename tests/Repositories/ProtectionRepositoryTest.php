<?php namespace Tests\Repositories;

use App\Models\Protection;
use App\Repositories\ProtectionRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeProtectionTrait;
use Tests\ApiTestTrait;

class ProtectionRepositoryTest extends TestCase
{
    use MakeProtectionTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ProtectionRepository
     */
    protected $protectionRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->protectionRepo = \App::make(ProtectionRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_protection()
    {
        $protection = $this->fakeProtectionData();
        $createdProtection = $this->protectionRepo->create($protection);
        $createdProtection = $createdProtection->toArray();
        $this->assertArrayHasKey('id', $createdProtection);
        $this->assertNotNull($createdProtection['id'], 'Created Protection must have id specified');
        $this->assertNotNull(Protection::find($createdProtection['id']), 'Protection with given id must be in DB');
        $this->assertModelData($protection, $createdProtection);
    }

    /**
     * @test read
     */
    public function test_read_protection()
    {
        $protection = $this->makeProtection();
        $dbProtection = $this->protectionRepo->find($protection->id);
        $dbProtection = $dbProtection->toArray();
        $this->assertModelData($protection->toArray(), $dbProtection);
    }

    /**
     * @test update
     */
    public function test_update_protection()
    {
        $protection = $this->makeProtection();
        $fakeProtection = $this->fakeProtectionData();
        $updatedProtection = $this->protectionRepo->update($fakeProtection, $protection->id);
        $this->assertModelData($fakeProtection, $updatedProtection->toArray());
        $dbProtection = $this->protectionRepo->find($protection->id);
        $this->assertModelData($fakeProtection, $dbProtection->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_protection()
    {
        $protection = $this->makeProtection();
        $resp = $this->protectionRepo->delete($protection->id);
        $this->assertTrue($resp);
        $this->assertNull(Protection::find($protection->id), 'Protection should not exist in DB');
    }
}
