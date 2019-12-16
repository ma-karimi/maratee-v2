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
}
