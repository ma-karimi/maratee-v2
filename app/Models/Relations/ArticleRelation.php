<?php


namespace App\Models\Relations;


use App\Models\Article;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait ArticleRelation
{

    /**
     * @return MorphToMany
     */
    public function actions(): MorphToMany
    {
        return $this->morphToMany(Article::class, 'articleable', 'article_hubs')
            ->whereNull('article_hubs.deleted_at')
            ->withTimestamps();
    }
}
