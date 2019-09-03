<?php namespace Tests\Repositories;

use App\Models\ActionHubDocument;
use App\Repositories\ActionHubDocumentRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ActionHubDocumentRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ActionHubDocumentRepository
     */
    protected $actionHubDocumentRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->actionHubDocumentRepo = \App::make(ActionHubDocumentRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_action_hub_document()
    {
        $actionHubDocument = factory(ActionHubDocument::class)->make()->toArray();

        $createdActionHubDocument = $this->actionHubDocumentRepo->create($actionHubDocument);

        $createdActionHubDocument = $createdActionHubDocument->toArray();
        $this->assertArrayHasKey('id', $createdActionHubDocument);
        $this->assertNotNull($createdActionHubDocument['id'], 'Created ActionHubDocument must have id specified');
        $this->assertNotNull(ActionHubDocument::find($createdActionHubDocument['id']), 'ActionHubDocument with given id must be in DB');
        $this->assertModelData($actionHubDocument, $createdActionHubDocument);
    }

    /**
     * @test read
     */
    public function test_read_action_hub_document()
    {
        $actionHubDocument = factory(ActionHubDocument::class)->create();

        $dbActionHubDocument = $this->actionHubDocumentRepo->find($actionHubDocument->id);

        $dbActionHubDocument = $dbActionHubDocument->toArray();
        $this->assertModelData($actionHubDocument->toArray(), $dbActionHubDocument);
    }

    /**
     * @test update
     */
    public function test_update_action_hub_document()
    {
        $actionHubDocument = factory(ActionHubDocument::class)->create();
        $fakeActionHubDocument = factory(ActionHubDocument::class)->make()->toArray();

        $updatedActionHubDocument = $this->actionHubDocumentRepo->update($fakeActionHubDocument, $actionHubDocument->id);

        $this->assertModelData($fakeActionHubDocument, $updatedActionHubDocument->toArray());
        $dbActionHubDocument = $this->actionHubDocumentRepo->find($actionHubDocument->id);
        $this->assertModelData($fakeActionHubDocument, $dbActionHubDocument->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_action_hub_document()
    {
        $actionHubDocument = factory(ActionHubDocument::class)->create();

        $resp = $this->actionHubDocumentRepo->delete($actionHubDocument->id);

        $this->assertTrue($resp);
        $this->assertNull(ActionHubDocument::find($actionHubDocument->id), 'ActionHubDocument should not exist in DB');
    }
}
