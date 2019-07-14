<?php namespace Tests\Repositories;

use App\Models\Paleontology;
use App\Repositories\PaleontologyRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakePaleontologyTrait;
use Tests\ApiTestTrait;

class PaleontologyRepositoryTest extends TestCase
{
    use MakePaleontologyTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var PaleontologyRepository
     */
    protected $paleontologyRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->paleontologyRepo = \App::make(PaleontologyRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_paleontology()
    {
        $paleontology = $this->fakePaleontologyData();
        $createdPaleontology = $this->paleontologyRepo->create($paleontology);
        $createdPaleontology = $createdPaleontology->toArray();
        $this->assertArrayHasKey('id', $createdPaleontology);
        $this->assertNotNull($createdPaleontology['id'], 'Created Paleontology must have id specified');
        $this->assertNotNull(Paleontology::find($createdPaleontology['id']), 'Paleontology with given id must be in DB');
        $this->assertModelData($paleontology, $createdPaleontology);
    }

    /**
     * @test read
     */
    public function test_read_paleontology()
    {
        $paleontology = $this->makePaleontology();
        $dbPaleontology = $this->paleontologyRepo->find($paleontology->id);
        $dbPaleontology = $dbPaleontology->toArray();
        $this->assertModelData($paleontology->toArray(), $dbPaleontology);
    }

    /**
     * @test update
     */
    public function test_update_paleontology()
    {
        $paleontology = $this->makePaleontology();
        $fakePaleontology = $this->fakePaleontologyData();
        $updatedPaleontology = $this->paleontologyRepo->update($fakePaleontology, $paleontology->id);
        $this->assertModelData($fakePaleontology, $updatedPaleontology->toArray());
        $dbPaleontology = $this->paleontologyRepo->find($paleontology->id);
        $this->assertModelData($fakePaleontology, $dbPaleontology->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_paleontology()
    {
        $paleontology = $this->makePaleontology();
        $resp = $this->paleontologyRepo->delete($paleontology->id);
        $this->assertTrue($resp);
        $this->assertNull(Paleontology::find($paleontology->id), 'Paleontology should not exist in DB');
    }
}
