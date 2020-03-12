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

trait MedicinalApplicationScope
{



    protected function processFoodIndustryFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereHas('foodIndustries', function ($query) use ($constraint) {
                return $query->whereHas('id', $constraint->getOperator(), $constraint->getValue());
            });

            return true;
        }
        return false;
    }

    protected function processOtherIndustryFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereHas('otherIndustries', function ($query) use ($constraint) {
                return $query->whereHas('id', $constraint->getOperator(), $constraint->getValue());
            });

            return true;
        }
        return false;
    }

    protected function processPotentialFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereHas('industrialPotentials', function ($query) use ($constraint) {
                return $query->whereHas('id', $constraint->getOperator(), $constraint->getValue());
            });

            return true;
        }
        return false;
    }


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

    protected function processMaterialFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereHas('locations', function ($query) use ($constraint) {
                $query->whereHas('effectiveMaterials', function ($key) use ($constraint) {
                    return $key->where('id', $constraint->getOperator(), $constraint->getValue());
                });
            });
            return true;
        }
        return false;
    }

    protected function processTreatmentFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereHas('locations', function ($query) use ($constraint) {
                return $query->where('treatment_id', $constraint->getOperator(), $constraint->getValue());
            });
            return true;
        }
        return false;
    }

    protected function processEfficiencyFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereHas('locations', function ($query) use ($constraint) {
                return $query->where('efficiency', $constraint->getOperator(), $constraint->getValue());
            });
            return true;
        }
        return false;
    }

    protected function processStudiedSampleFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereHas('locations', function ($query) use ($constraint) {
                return $query->where('studied_sample', $constraint->getOperator(), $constraint->getValue());
            });
            return true;
        }
        return false;
    }

    protected function processInCountryFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereHas('locations', function ($query) use ($constraint) {
                return $query->where('presence_in_country', $constraint->getOperator(), $constraint->getValue());
            });
            return true;
        }
        return false;
    }


    protected function processHygenicFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->where('hygienic_cosmetic_industry_id', $constraint->getOperator(), $constraint->getValue());

            return true;
        }
        return false;
    }


}
