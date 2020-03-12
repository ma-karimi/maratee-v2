<?php
/**
 * Created by PhpStorm.
 * User: alireza
 * Date: 7/13/19
 * Time: 4:03 PM
 */

namespace App\Models\Scope;


use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Database\Eloquent\Builder;
use Jedrzej\Searchable\Constraint;
use League\Geotools\Coordinate\Coordinate;

trait PlantScope
{

    protected function processTaxonomy_Authors_IdFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereHas('taxonomy', function ($query) use ($constraint) {
                return $query
                    ->whereHas('species', function ($key) use ($constraint) {
                        return $key->whereHas('authors', function ($author) use ($constraint) {
                            return $author->where('actor_hubs.actor_id', $constraint->getOperator(), $constraint->getValue());
                        });
                    })
                    ->orWhereHas('subspecies', function ($key) use ($constraint) {
                        return $key->whereHas('authors', function ($author) use ($constraint) {
                            return $author->where('actor_hubs.actor_id', $constraint->getOperator(), $constraint->getValue());
                        });
                    })
                    ->orWhereHas('variety', function ($key) use ($constraint) {
                        return $key->whereHas('authors', function ($author) use ($constraint) {
                            return $author->where('actor_hubs.actor_id', $constraint->getOperator(), $constraint->getValue());
                        });
                    });

            });

            return true;
        }
        return false;
    }

}
