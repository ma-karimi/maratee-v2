<?php namespace Tests\Repositories;

use App\Models\ArticleHub;
use App\Repositories\ArticleHubRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeArticleHubTrait;
use Tests\ApiTestTrait;

class ArticleHubRepositoryTest extends TestCase
{
    use MakeArticleHubTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ArticleHubRepository
     */
    protected $articleHubRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->articleHubRepo = \App::make(ArticleHubRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_article_hub()
    {
        $articleHub = $this->fakeArticleHubData();
        $createdArticleHub = $this->articleHubRepo->create($articleHub);
        $createdArticleHub = $createdArticleHub->toArray();
        $this->assertArrayHasKey('id', $createdArticleHub);
        $this->assertNotNull($createdArticleHub['id'], 'Created ArticleHub must have id specified');
        $this->assertNotNull(ArticleHub::find($createdArticleHub['id']), 'ArticleHub with given id must be in DB');
        $this->assertModelData($articleHub, $createdArticleHub);
    }

    /**
     * @test read
     */
    public function test_read_article_hub()
    {
        $articleHub = $this->makeArticleHub();
        $dbArticleHub = $this->articleHubRepo->find($articleHub->id);
        $dbArticleHub = $dbArticleHub->toArray();
        $this->assertModelData($articleHub->toArray(), $dbArticleHub);
    }

    /**
     * @test update
     */
    public function test_update_article_hub()
    {
        $articleHub = $this->makeArticleHub();
        $fakeArticleHub = $this->fakeArticleHubData();
        $updatedArticleHub = $this->articleHubRepo->update($fakeArticleHub, $articleHub->id);
        $this->assertModelData($fakeArticleHub, $updatedArticleHub->toArray());
        $dbArticleHub = $this->articleHubRepo->find($articleHub->id);
        $this->assertModelData($fakeArticleHub, $dbArticleHub->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_article_hub()
    {
        $articleHub = $this->makeArticleHub();
        $resp = $this->articleHubRepo->delete($articleHub->id);
        $this->assertTrue($resp);
        $this->assertNull(ArticleHub::find($articleHub->id), 'ArticleHub should not exist in DB');
    }
}
