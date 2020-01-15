<?php
/**
 * Created by PhpStorm.
 * User: alireza
 * Date: 7/13/19
 * Time: 4:03 PM
 */

namespace App\Models\Scope;


use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Database\Eloquent\Builder;
use Jedrzej\Searchable\Constraint;

trait PaleontologyScope
{


    protected function processLocality_CountryIdFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereHas('locality', function ($query) use ($constraint) {
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

    protected function processLocality_CityIdFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereHas('locality', function ($query) use ($constraint) {
                return $query->whereHas('location', function ($location) use ($constraint) {
                    return $location->where('city_id', $constraint->getOperator(), $constraint->getValue());
                });
            });

            return true;
        }
        return false;
    }

    protected function processLocality_VillageFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereHas('locality', function ($query) use ($constraint) {
                return $query->whereHas('location', function ($location) use ($constraint) {
                    return $location->where('village', $constraint->getOperator(), $constraint->getValue());
                });
            });

            return true;
        }
        return false;
    }

    protected function processLocality_ProvinceIdFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereHas('locality', function ($query) use ($constraint) {
                return $query->whereHas('location', function ($location) use ($constraint) {
                    return $location->where('province_id', $constraint->getOperator(), $constraint->getValue());
                });
            });

            return true;
        }
        return false;
    }


    protected function processLocation_PointFilter(Builder $builder, Constraint $constraint)
    {
        $data = $constraint->getValue();
        if ($constraint->getOperator() === Constraint::OPERATOR_IN) {

            $builder
                ->whereHas('locality', function ($herbarium) use ($data) {
                    return $herbarium->whereHas('location', function ($query) use ($data) {
                        return $query->distance('point', new Point($data[0], $data[1]), 1);
                    });
                });


            return true;
        }
        return false;
    }

    protected function processDeterminerFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereHas('determine', function ($determine) use ($constraint) {
                return $determine->whereHas('actors', function ($key) use ($constraint) {
                    return $key->where('actor_hubs.actor_id', $constraint->getOperator(), $constraint->getValue());
                });
            });

            return true;
        }
        return false;
    }

    protected function processCollectorFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereHas('collect', function ($determine) use ($constraint) {
                return $determine->whereHas('actors', function ($key) use ($constraint) {
                    return $key->where('actor_hubs.actor_id', $constraint->getOperator(), $constraint->getValue());
                });
            });

            return true;
        }
        return false;
    }

    protected function processCitations_AuthorsFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereHas('citations', function ($determine) use ($constraint) {
                return $determine->whereHas('actors', function ($key) use ($constraint) {
                    return $key->where('actor_hubs.actor_id', $constraint->getOperator(), $constraint->getValue());
                });
            });

            return true;
        }
        return false;
    }

}
