<?php


namespace App\Models\Scope;


use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Database\Eloquent\Builder;
use Jedrzej\Searchable\Constraint;

trait ChromosomeScope
{

    protected function processArticle_ActorFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereHas('articles', function ($article) use ($constraint) {
                return $article->whereHas('actors', function ($key) use ($constraint) {
                    return $key->where('actor_hubs.actor_id', $constraint->getOperator(), $constraint->getValue());
                });
            });

            return true;
        }
        return false;
    }

}
