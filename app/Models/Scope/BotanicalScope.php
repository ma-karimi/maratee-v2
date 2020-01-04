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

trait BotanicalScope
{


    protected function processLocations_CountryIdFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereHas('locations', function ($query) use ($constraint) {
                return $query->whereHas('location', function ($location) use ($constraint) {
                    return $location
                        ->whereHas('province', function ($province) use ($constraint) {
                            return $province->where('country_id', $constraint->getOperator(), $constraint->getValue());
                        });
                });
            });

            return true;
        }
        return false;
    }

    protected function processLocations_CityIdFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereHas('locations', function ($query) use ($constraint) {
                return $query->whereHas('location', function ($location) use ($constraint) {
                    return $location->where('city_id', $constraint->getOperator(), $constraint->getValue());
                });
            });

            return true;
        }
        return false;
    }

    protected function processLocations_VillageFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereHas('locations', function ($query) use ($constraint) {
                return $query->whereHas('location', function ($location) use ($constraint) {
                    return $location->where('village', $constraint->getOperator(), $constraint->getValue());
                });
            });

            return true;
        }
        return false;
    }

    protected function processLocations_ProvinceIdFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereHas('locations', function ($query) use ($constraint) {
                return $query->whereHas('location', function ($location) use ($constraint) {
                    return $location->where('province_id', $constraint->getOperator(), $constraint->getValue());
                });
            });

            return true;
        }
        return false;
    }


}
