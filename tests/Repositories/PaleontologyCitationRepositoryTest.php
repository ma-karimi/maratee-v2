<?php namespace Tests\Repositories;

use App\Models\Citation;
use App\Repositories\CitationRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakePaleontologyCitationTrait;
use Tests\ApiTestTrait;

class PaleontologyCitationRepositoryTest extends TestCase
{
    use MakePaleontologyCitationTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var CitationRepository
     */
    protected $paleontologyCitationRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->paleontologyCitationRepo = \App::make(CitationRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_paleontology_citation()
    {
        $paleontologyCitation = $this->fakePaleontologyCitationData();
        $createdPaleontologyCitation = $this->paleontologyCitationRepo->create($paleontologyCitation);
        $createdPaleontologyCitation = $createdPaleontologyCitation->toArray();
        $this->assertArrayHasKey('id', $createdPaleontologyCitation);
        $this->assertNotNull($createdPaleontologyCitation['id'], 'Created PaleontologyCitation must have id specified');
        $this->assertNotNull(Citation::find($createdPaleontologyCitation['id']), 'PaleontologyCitation with given id must be in DB');
        $this->assertModelData($paleontologyCitation, $createdPaleontologyCitation);
    }

    /**
     * @test read
     */
    public function test_read_paleontology_citation()
    {
        $paleontologyCitation = $this->makePaleontologyCitation();
        $dbPaleontologyCitation = $this->paleontologyCitationRepo->find($paleontologyCitation->id);
        $dbPaleontologyCitation = $dbPaleontologyCitation->toArray();
        $this->assertModelData($paleontologyCitation->toArray(), $dbPaleontologyCitation);
    }

    /**
     * @test update
     */
    public function test_update_paleontology_citation()
    {
        $paleontologyCitation = $this->makePaleontologyCitation();
        $fakePaleontologyCitation = $this->fakePaleontologyCitationData();
        $updatedPaleontologyCitation = $this->paleontologyCitationRepo->update($fakePaleontologyCitation, $paleontologyCitation->id);
        $this->assertModelData($fakePaleontologyCitation, $updatedPaleontologyCitation->toArray());
        $dbPaleontologyCitation = $this->paleontologyCitationRepo->find($paleontologyCitation->id);
        $this->assertModelData($fakePaleontologyCitation, $dbPaleontologyCitation->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_paleontology_citation()
    {
        $paleontologyCitation = $this->makePaleontologyCitation();
        $resp = $this->paleontologyCitationRepo->delete($paleontologyCitation->id);
        $this->assertTrue($resp);
        $this->assertNull(Citation::find($paleontologyCitation->id), 'PaleontologyCitation should not exist in DB');
    }
}
