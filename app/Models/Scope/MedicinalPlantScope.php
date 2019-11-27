<?php
/**
 * Created by PhpStorm.
 * User: alireza
 * Date: 7/13/19
 * Time: 4:03 PM
 */

namespace App\Models\Scope;


use Illuminate\Database\Eloquent\Builder;
use Jedrzej\Searchable\Constraint;

trait MedicinalPlantScope
{


    // use one filter to search in multiple columns
    protected function processConstituents_ConstituentTypeIdFilter(Builder $builder, Constraint $constraint)
    {
        // this logic should happen for LIKE/EQUAL operators only
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereHas('medicinal_plant_constituents', function ($query) use ($constraint) {
                return $query->where('constituent_type_id', $constraint->getOperator(), $constraint->getValue());

            });

            return true;
        }

        // default logic should be executed otherwise
        return false;
    }

    protected function processArticle_Actors_IdFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereHas('article', function ($query) use ($constraint) {
                return $query->whereHas('authors', function ($author) use ($constraint) {
                    return $author->where('actor_hubs.actor_id', $constraint->getOperator(), $constraint->getValue());
                });

            });

            return true;
        }
        return false;
    }

    protected function processDetermine_Actors_IdFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereHas('determine', function ($query) use ($constraint) {
                    return $query->whereHas('actors', function ($key) use ($constraint) {
                        return $key->where('actor_hubs.actor_id', $constraint->getOperator(), $constraint->getValue());
                    });
                });
            return true;
        }
        return false;
    }

    protected function processCollect_Actors_IdFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereHas('collect', function ($query) use ($constraint) {
                    return $query->whereHas('actors', function ($key) use ($constraint) {
                        return $key->where('actor_hubs.actor_id', $constraint->getOperator(), $constraint->getValue());
                    });
                });
            return true;
        }
        return false;
    }


    protected function processProvinces_IdFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereHas('provinces', function ($query) use ($constraint) {
                return $query->where('id', $constraint->getOperator(), $constraint->getValue());

            });

            return true;
        }
        return false;
    }

}
