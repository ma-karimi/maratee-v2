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
    /**
     * @param $query
     * @return mixed
     */
    public function scopeIsFlowering($query, $value)
    {
        return $query->where('is_flowering', $value);
    }

    /**
     * @param $query
     * @param bool $value
     * @return mixed
     */
    public function scopeOfFloweringHerbariums($query, bool $value = false)
    {
        return $query->whereHas('herbariums', function ($query) use ($value) {
            $query->isFlowering($value);
        });
    }

    // use one filter to search in multiple columns
    protected function processLocations_AddressEnFilter(Builder $builder, Constraint $constraint)
    {
        // this logic should happen for LIKE/EQUAL operators only
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereHas('locations', function ($query) use ($constraint) {
                return $query->whereHas('location', function ($key) use ($constraint) {
                    return $key->where('address_en', $constraint->getOperator(), $constraint->getValue());
                });

            });

            return true;
        }

        // default logic should be executed otherwise
        return false;
    }
}
