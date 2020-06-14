<?php


namespace App\Models\Scope;


use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Database\Eloquent\Builder;
use Jedrzej\Searchable\Constraint;

trait HerbariumScope
{

    protected function processLocation_PointFilter(Builder $builder, Constraint $constraint)
    {
        $data = $constraint->getValue();
        if ($constraint->getOperator() === Constraint::OPERATOR_IN) {

            $builder
                ->whereHas('herbarium', function ($herbarium) use ($data) {
                    return $herbarium->whereHas('location', function ($query) use ($data) {
                        return $query->distance('point', new Point($data[0], $data[1]), 1);
                    });
                });


            return true;
        }
        return false;
    }


    protected function processLocation_CountryIdFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereHas('location', function ($query) use ($constraint) {
                return $query
                    ->whereHas('province', function ($province) use ($constraint) {
                        return $province->where('country_id', $constraint->getOperator(), $constraint->getValue());
                    });
            });

            return true;
        }
        return false;
    }


    protected function processDeterminerFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereHas('determiners', function ($determine) use ($constraint) {
                return $determine->where('action_actors.actor_id', $constraint->getOperator(), $constraint->getValue());
            });

            return true;
        }
        return false;
    }

    protected function processCollectorFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereHas('collect', function ($determine) use ($constraint) {
                return $determine->where('action_actors.actor_id', $constraint->getOperator(), $constraint->getValue());
            });

            return true;
        }
        return false;
    }

}
