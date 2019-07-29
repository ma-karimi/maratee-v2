<?php namespace Tests\Apis;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeArticleHubTrait;
use Tests\ApiTestTrait;

class ArticleHubApiTest extends TestCase
{
    use MakeArticleHubTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_article_hub()
    {
        $articleHub = $this->fakeArticleHubData();
        $this->response = $this->json('POST', '/api/articleHubs', $articleHub);

        $this->assertApiResponse($articleHub);
    }

    /**
     * @test
     */
    public function test_read_article_hub()
    {
        $articleHub = $this->makeArticleHub();
        $this->response = $this->json('GET', '/api/articleHubs/'.$articleHub->id);

        $this->assertApiResponse($articleHub->toArray());
    }

    /**
     * @test
     */
    public function test_update_article_hub()
    {
        $articleHub = $this->makeArticleHub();
        $editedArticleHub = $this->fakeArticleHubData();

        $this->response = $this->json('PUT', '/api/articleHubs/'.$articleHub->id, $editedArticleHub);

        $this->assertApiResponse($editedArticleHub);
    }

    /**
     * @test
     */
    public function test_delete_article_hub()
    {
        $articleHub = $this->makeArticleHub();
        $this->response = $this->json('DELETE', '/api/articleHubs/'.$articleHub->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/articleHubs/'.$articleHub->id);

        $this->response->assertStatus(404);
    }
}
