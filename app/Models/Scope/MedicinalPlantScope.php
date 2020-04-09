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


    protected function processMetaboliteFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereHas('locations', function ($query) use ($constraint) {
                $query->whereHas('secondaryMetabolites', function ($key) use ($constraint) {
                    return $key->where('id', $constraint->getOperator(), $constraint->getValue());
                });
            });
            return true;
        }
        return false;
    }

}
