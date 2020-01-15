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


    // use one filter to search in multiple columns
    protected function processConstituentFilter(Builder $builder, Constraint $constraint)
    {
        // this logic should happen for LIKE/EQUAL operators only
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereHas('locations', function ($query) use ($constraint) {
                $query->whereHas('constituents', function ($constituent_types) use ($constraint) {
                    return $constituent_types->where('constituent_type_id', $constraint->getOperator(), $constraint->getValue());
                });
            });

            return true;
        }

        // default logic should be executed otherwise
        return false;
    }

    protected function processActorsFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereHas('locations', function ($query) use ($constraint) {
                $query->whereHas('article', function ($article) use ($constraint) {
                    return $article->whereHas('authors', function ($author) use ($constraint) {
                        return $author->where('actor_hubs.actor_id', $constraint->getOperator(), $constraint->getValue());
                    });
                });

            });

            return true;
        }
        return false;
    }

    protected function processArticleFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereHas('locations', function ($query) use ($constraint) {
                $query->whereHas('article', function ($article) use ($constraint) {
                    return $article->whereHas('title', $constraint->getOperator(), $constraint->getValue());
                });
            });

            return true;
        }
        return false;
    }

    protected function processMedicineFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereHas('medicines', function ($query) use ($constraint) {
                return $query->whereHas('id', $constraint->getOperator(), $constraint->getValue());
            });

            return true;
        }
        return false;
    }

    protected function processProductFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereHas('products', function ($query) use ($constraint) {
                return $query->whereHas('id', $constraint->getOperator(), $constraint->getValue());
            });

            return true;
        }
        return false;
    }

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

    protected function processDeterminatorsFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereHas('locations', function ($query) use ($constraint) {
                $query->whereHas('determine', function ($determine) use ($constraint) {
                    return $determine->whereHas('actors', function ($key) use ($constraint) {
                        return $key->where('actor_hubs.actor_id', $constraint->getOperator(), $constraint->getValue());
                    });
                });
            });
            return true;
        }
        return false;
    }

    protected function processCollectDateFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereHas('locations', function ($query) use ($constraint) {
                $query->whereHas('collect', function ($collect) use ($constraint) {
                    return $collect->where('date', $constraint->getOperator(), $constraint->getValue());
                });
            });
            return true;
        }
        return false;
    }

    protected function processCollectorFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereHas('locations', function ($query) use ($constraint) {
                $query->whereHas('collect', function ($collect) use ($constraint) {
                    return $collect->whereHas('actors', function ($key) use ($constraint) {
                        return $key->where('actor_hubs.actor_id', $constraint->getOperator(), $constraint->getValue());
                    });
                });
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

    protected function processPropertiesFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->where('medicinal_properties', $constraint->getOperator(), $constraint->getValue());;
            return true;
        }
        return false;
    }

    protected function processPhenologyFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereHas('locations', function ($query) use ($constraint) {
                return $query->where('phenology_id', $constraint->getOperator(), $constraint->getValue());
            });
            return true;
        }
        return false;
    }

    protected function processDistillationFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereHas('locations', function ($query) use ($constraint) {
                return $query->where('method_distillation_id', $constraint->getOperator(), $constraint->getValue());
            });
            return true;
        }
        return false;
    }

    protected function processPheonologyFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereHas('locations', function ($query) use ($constraint) {
                return $query->where('phenology_id', $constraint->getOperator(), $constraint->getValue());
            });
            return true;
        }
        return false;
    }

    protected function processExtractionFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereHas('locations', function ($query) use ($constraint) {
                return $query->where('method_extraction_id', $constraint->getOperator(), $constraint->getValue());
            });
            return true;
        }
        return false;
    }

    protected function processAnalyseFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereHas('locations', function ($query) use ($constraint) {
                return $query->where('method_analyse_id', $constraint->getOperator(), $constraint->getValue());
            });
            return true;
        }
        return false;
    }

    protected function processHerbariumFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereHas('locations', function ($query) use ($constraint) {
                return $query->where('herbarium_number', $constraint->getOperator(), $constraint->getValue());
            });
            return true;
        }
        return false;
    }


    protected function processProvinceFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->whereHas('provinces', function ($query) use ($constraint) {
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

    protected function processHygenicFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->where('hygienic_cosmetic_industry_id', $constraint->getOperator(), $constraint->getValue());

            return true;
        }
        return false;
    }


}
