<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\ArticleHub;
use App\Repositories\ArticleHubRepository;

trait MakeArticleHubTrait
{
    /**
     * Create fake instance of ArticleHub and save it in database
     *
     * @param array $articleHubFields
     * @return ArticleHub
     */
    public function makeArticleHub($articleHubFields = [])
    {
        /** @var ArticleHubRepository $articleHubRepo */
        $articleHubRepo = \App::make(ArticleHubRepository::class);
        $theme = $this->fakeArticleHubData($articleHubFields);
        return $articleHubRepo->create($theme);
    }

    /**
     * Get fake instance of ArticleHub
     *
     * @param array $articleHubFields
     * @return ArticleHub
     */
    public function fakeArticleHub($articleHubFields = [])
    {
        return new ArticleHub($this->fakeArticleHubData($articleHubFields));
    }

    /**
     * Get fake data of ArticleHub
     *
     * @param array $articleHubFields
     * @return array
     */
    public function fakeArticleHubData($articleHubFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $articleHubFields);
    }
}
