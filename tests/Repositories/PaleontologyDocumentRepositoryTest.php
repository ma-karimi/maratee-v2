<?php namespace Tests\Repositories;

use App\Models\PaleontologyDocument;
use App\Repositories\PaleontologyDocumentRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class PaleontologyDocumentRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var PaleontologyDocumentRepository
     */
    protected $paleontologyDocumentRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->paleontologyDocumentRepo = \App::make(PaleontologyDocumentRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_paleontology_document()
    {
        $paleontologyDocument = factory(PaleontologyDocument::class)->make()->toArray();

        $createdPaleontologyDocument = $this->paleontologyDocumentRepo->create($paleontologyDocument);

        $createdPaleontologyDocument = $createdPaleontologyDocument->toArray();
        $this->assertArrayHasKey('id', $createdPaleontologyDocument);
        $this->assertNotNull($createdPaleontologyDocument['id'], 'Created PaleontologyDocument must have id specified');
        $this->assertNotNull(PaleontologyDocument::find($createdPaleontologyDocument['id']), 'PaleontologyDocument with given id must be in DB');
        $this->assertModelData($paleontologyDocument, $createdPaleontologyDocument);
    }

    /**
     * @test read
     */
    public function test_read_paleontology_document()
    {
        $paleontologyDocument = factory(PaleontologyDocument::class)->create();

        $dbPaleontologyDocument = $this->paleontologyDocumentRepo->find($paleontologyDocument->id);

        $dbPaleontologyDocument = $dbPaleontologyDocument->toArray();
        $this->assertModelData($paleontologyDocument->toArray(), $dbPaleontologyDocument);
    }

    /**
     * @test update
     */
    public function test_update_paleontology_document()
    {
        $paleontologyDocument = factory(PaleontologyDocument::class)->create();
        $fakePaleontologyDocument = factory(PaleontologyDocument::class)->make()->toArray();

        $updatedPaleontologyDocument = $this->paleontologyDocumentRepo->update($fakePaleontologyDocument, $paleontologyDocument->id);

        $this->assertModelData($fakePaleontologyDocument, $updatedPaleontologyDocument->toArray());
        $dbPaleontologyDocument = $this->paleontologyDocumentRepo->find($paleontologyDocument->id);
        $this->assertModelData($fakePaleontologyDocument, $dbPaleontologyDocument->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_paleontology_document()
    {
        $paleontologyDocument = factory(PaleontologyDocument::class)->create();

        $resp = $this->paleontologyDocumentRepo->delete($paleontologyDocument->id);

        $this->assertTrue($resp);
        $this->assertNull(PaleontologyDocument::find($paleontologyDocument->id), 'PaleontologyDocument should not exist in DB');
    }
}
