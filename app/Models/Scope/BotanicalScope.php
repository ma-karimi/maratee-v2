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

    protected function processOrigins_IdFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereHas('origins', function ($query) use ($constraint) {
                return $query->where('botanical_generals.id', $constraint->getOperator(), $constraint->getValue());
            });

            return true;
        }
        return false;
    }

    protected function processInternalHabitats_IdFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereHas('internalHabitats', function ($query) use ($constraint) {
                return $query->where('botanical_generals.id', $constraint->getOperator(), $constraint->getValue());
            });

            return true;
        }
        return false;
    }

    protected function processGardens_IdFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereHas('gardens', function ($query) use ($constraint) {
                return $query->where('botanical_generals.id', $constraint->getOperator(), $constraint->getValue());
            });

            return true;
        }
        return false;
    }

    protected function processValues_IdFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereHas('values', function ($query) use ($constraint) {
                return $query->where('botanical_generals.id', $constraint->getOperator(), $constraint->getValue());
            });

            return true;
        }
        return false;
    }

    protected function processUsages_IdFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereHas('usages', function ($query) use ($constraint) {
                return $query->where('botanical_generals.id', $constraint->getOperator(), $constraint->getValue());
            });

            return true;
        }
        return false;
    }

    protected function processPropagations_IdFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereHas('propagations', function ($query) use ($constraint) {
                return $query->where('botanical_generals.id', $constraint->getOperator(), $constraint->getValue());
            });

            return true;
        }
        return false;
    }

    protected function processPlantingConditions_IdFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereHas('plantingConditions', function ($query) use ($constraint) {
                return $query->where('botanical_generals.id', $constraint->getOperator(), $constraint->getValue());
            });

            return true;
        }
        return false;
    }

    protected function processCycles_IdFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereHas('cycles', function ($query) use ($constraint) {
                return $query->where('botanical_generals.id', $constraint->getOperator(), $constraint->getValue());
            });

            return true;
        }
        return false;
    }

    protected function processHabitats_IdFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereHas('habitats', function ($query) use ($constraint) {
                return $query->where('botanical_generals.id', $constraint->getOperator(), $constraint->getValue());
            });

            return true;
        }
        return false;
    }

    protected function processFoliageColors_IdFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereHas('foliageColors', function ($query) use ($constraint) {
                return $query->where('botanical_colors.id', $constraint->getOperator(), $constraint->getValue());
            });

            return true;
        }
        return false;
    }

    protected function processFlowerColors_IdFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereHas('flowerColors', function ($query) use ($constraint) {
                return $query->where('botanical_colors.id', $constraint->getOperator(), $constraint->getValue());
            });

            return true;
        }
        return false;
    }

    protected function processFruitColors_IdFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereHas('fruitColors', function ($query) use ($constraint) {
                return $query->where('botanical_colors.id', $constraint->getOperator(), $constraint->getValue());
            });

            return true;
        }
        return false;
    }

    protected function processGeographicals_IdFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereHas('distributions', function ($query) use ($constraint) {
                return $query->where('geographicals.id', $constraint->getOperator(), $constraint->getValue());
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
