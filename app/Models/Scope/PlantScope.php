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

trait PlantScope
{

    protected function processTaxonomy_AuthorsFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereHas('taxonomy', function ($query) use ($constraint) {
                return $query
                    ->where('species_authors', $constraint->getOperator(), $constraint->getValue())
                    ->orWhere('subspecies_authors', $constraint->getOperator(), $constraint->getValue())
                    ->where('variety_authors', $constraint->getOperator(), $constraint->getValue());

            });

            return true;
        }
        return false;
    }

    protected function processPhytogeographicsFilter(Builder $builder, Constraint $constraint)
    {
        // this logic should happen for LIKE/EQUAL operators only

        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereJsonContains('phytogeographics', ['id' => $constraint->getValue()]);

            return true;
        }

        // default logic should be executed otherwise
        return false;
    }

    protected function processlifeFormsFilter(Builder $builder, Constraint $constraint)
    {
        // this logic should happen for LIKE/EQUAL operators only

        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereJsonContains('life_forms', ['id' => $constraint->getValue()]);

            return true;
        }

        // default logic should be executed otherwise
        return false;
    }

}
