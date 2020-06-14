<?php
/**
 * Created by PhpStorm.
 * User: alireza
 * Date: 7/13/19
 * Time: 4:03 PM
 */

namespace App\Models\Scope;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;
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
                Log::info([$constraint->getOperator(), $constraint->getValue()]);
                return $query->where('species_authors', $constraint->getOperator(), $constraint->getValue())
                    ->orWhere('subspecies_authors', $constraint->getOperator(), $constraint->getValue())
                    ->orWhere('variety_authors', $constraint->getOperator(), $constraint->getValue());
            });

            return true;
        }
        return false;
    }
}
