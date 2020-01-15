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
use League\Geotools\Coordinate\Coordinate;

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
                return $query->where('address_en', $constraint->getOperator(), $constraint->getValue());

            });

            return true;
        }

        // default logic should be executed otherwise
        return false;
    }

    // use one filter to search in multiple columns
    protected function processLocations_MinAltitudeFilter(Builder $builder, Constraint $constraint)
    {
        // this logic should happen for LIKE/EQUAL operators only
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereHas('locations', function ($query) use ($constraint) {
                return $query->where('min_altitude', $constraint->getOperator(), $constraint->getValue());

            });

            return true;
        }

        // default logic should be executed otherwise
        return false;
    }

    // use one filter to search in multiple columns
    protected function processLocations_MaxAltitudeFilter(Builder $builder, Constraint $constraint)
    {
        // this logic should happen for LIKE/EQUAL operators only
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereHas('locations', function ($query) use ($constraint) {
                return $query->where('max_altitude', $constraint->getOperator(), $constraint->getValue());

            });

            return true;
        }

        // default logic should be executed otherwise
        return false;
    }

    protected function processGeographicals_IdFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereHas('geographicals', function ($query) use ($constraint) {
                return $query->where('id', $constraint->getOperator(), $constraint->getValue());

            });

            return true;
        }
        return false;
    }

    protected function processLocations_CountryIdFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereHas('locations', function ($query) use ($constraint) {
                    return $query
                        ->whereHas('province', function ($province) use ($constraint) {
                            return $province->where('country_id', $constraint->getOperator(), $constraint->getValue());
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
                return $query->where('city_id', $constraint->getOperator(), $constraint->getValue());

            });

            return true;
        }
        return false;
    }

    protected function processLocations_VillageFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereHas('locations', function ($query) use ($constraint) {
                return $query->where('village', $constraint->getOperator(), $constraint->getValue());

            });

            return true;
        }
        return false;
    }

    protected function processLocations_ProvinceIdFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereHas('locations', function ($query) use ($constraint) {
                return $query->where('province_id', $constraint->getOperator(), $constraint->getValue());

            });

            return true;
        }
        return false;
    }

    protected function processLocations_PointFilter(Builder $builder, Constraint $constraint)
    {
        $data = $constraint->getValue();
        if ($constraint->getOperator() === Constraint::OPERATOR_IN) {
            $builder->whereHas('locations', function ($query) use ($data) {
                $coordinate = new Coordinate(implode(', ', $data));
                return $query->distance('point', new Point($coordinate->getLatitude(), $coordinate->getLongitude()), 1);

            });

            return true;
        }
        return false;
    }

    protected function processGeneralSubstrate_TypeFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {

            $builder
                ->whereHas('generalSubstrate', function ($substrate) use ($constraint) {
                    return $substrate->where('type', $constraint->getOperator(), $constraint->getValue());
                });


            return true;
        }
        return false;
    }


    protected function processTaxonomy_Authors_IdFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereHas('taxonomy', function ($query) use ($constraint) {
                return $query
                    ->whereHas('species', function ($key) use ($constraint) {
                        return $key->whereHas('authors', function ($author) use ($constraint) {
                            return $author->where('actor_hubs.actor_id', $constraint->getOperator(), $constraint->getValue());
                        });
                    })
                    ->orWhereHas('subspecies', function ($key) use ($constraint) {
                        return $key->whereHas('authors', function ($author) use ($constraint) {
                            return $author->where('actor_hubs.actor_id', $constraint->getOperator(), $constraint->getValue());
                        });
                    })
                    ->orWhereHas('variety', function ($key) use ($constraint) {
                        return $key->whereHas('authors', function ($author) use ($constraint) {
                            return $author->where('actor_hubs.actor_id', $constraint->getOperator(), $constraint->getValue());
                        });
                    });

            });

            return true;
        }
        return false;
    }

}
