<?php namespace Tests\Repositories;

use App\Models\Constituent;
use App\Repositories\ConstituentRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeConstituentTrait;
use Tests\ApiTestTrait;

class ConstituentRepositoryTest extends TestCase
{
    use MakeConstituentTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ConstituentRepository
     */
    protected $constituentRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->constituentRepo = \App::make(ConstituentRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_constituent()
    {
        $constituent = $this->fakeConstituentData();
        $createdConstituent = $this->constituentRepo->create($constituent);
        $createdConstituent = $createdConstituent->toArray();
        $this->assertArrayHasKey('id', $createdConstituent);
        $this->assertNotNull($createdConstituent['id'], 'Created Constituent must have id specified');
        $this->assertNotNull(Constituent::find($createdConstituent['id']), 'Constituent with given id must be in DB');
        $this->assertModelData($constituent, $createdConstituent);
    }

    /**
     * @test read
     */
    public function test_read_constituent()
    {
        $constituent = $this->makeConstituent();
        $dbConstituent = $this->constituentRepo->find($constituent->id);
        $dbConstituent = $dbConstituent->toArray();
        $this->assertModelData($constituent->toArray(), $dbConstituent);
    }

    /**
     * @test update
     */
    public function test_update_constituent()
    {
        $constituent = $this->makeConstituent();
        $fakeConstituent = $this->fakeConstituentData();
        $updatedConstituent = $this->constituentRepo->update($fakeConstituent, $constituent->id);
        $this->assertModelData($fakeConstituent, $updatedConstituent->toArray());
        $dbConstituent = $this->constituentRepo->find($constituent->id);
        $this->assertModelData($fakeConstituent, $dbConstituent->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_constituent()
    {
        $constituent = $this->makeConstituent();
        $resp = $this->constituentRepo->delete($constituent->id);
        $this->assertTrue($resp);
        $this->assertNull(Constituent::find($constituent->id), 'Constituent should not exist in DB');
    }
}
