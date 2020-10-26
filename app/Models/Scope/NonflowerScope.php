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

trait NonflowerScope
{


    public function scopeOfSelect($query)
    {
        return $query->select('id', 'name');
    }


    protected function processTaxonomy_AuthorsFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereHas('taxonomy', function ($query) use ($constraint) {
                return $query->where('species_authors', $constraint->getOperator(), $constraint->getValue())
                    ->orWhere('subspecies_authors', $constraint->getOperator(), $constraint->getValue())
                    ->orWhere('variety_authors', $constraint->getOperator(), $constraint->getValue());
            });

            return true;
        }
        return false;
    }


    protected function processHerbariumNumbersFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_IN) {
            $builder
                ->where('herbarium_number', '>=', (integer)$constraint->getValue()[0])
                ->where('herbarium_number', '<=', (integer)$constraint->getValue()[1])
                ->orderBy('herbarium_number');

            return true;
        }
        return false;
    }
}
