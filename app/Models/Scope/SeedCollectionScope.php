<?php


namespace App\Models\Scope;


use Illuminate\Database\Eloquent\Builder;
use Jedrzej\Searchable\Constraint;

trait SeedCollectionScope
{
    protected function processLocationCountryFilter(Builder $builder, Constraint $constraint)
    {
        $data = $constraint->getValue();

        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->where('location->country_name', 'LIKE', "%${data}%");
            return true;
        }
        return false;
    }

    protected function processLocationProvinceFilter(Builder $builder, Constraint $constraint)
    {
        $data = $constraint->getValue();

        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->where('location->provincestate', 'LIKE', "%${data}%");
            return true;
        }
        return false;
    }

    protected function processLocationCityFilter(Builder $builder, Constraint $constraint)
    {
        $data = $constraint->getValue();

        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->where('location->city', 'LIKE', "%${data}%");
            return true;
        }
        return false;
    }

    protected function processLocationRegionFilter(Builder $builder, Constraint $constraint)
    {
        $data = $constraint->getValue();

        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->where('location->region', 'LIKE', "%${data}%");
            return true;
        }
        return false;
    }

    protected function processLocationVillageFilter(Builder $builder, Constraint $constraint)
    {
        $data = $constraint->getValue();

        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->where('location->villageroad_no_or_name', 'LIKE', "%${data}%");
            return true;
        }
        return false;
    }

    protected function processLocationALtitudeFilter(Builder $builder, Constraint $constraint)
    {
        $data = $constraint->getValue();

        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->where('location->altitude_m', '=', "%${data}%");
            return true;
        }
        return false;
    }

    protected function processLocationGpsUsedFilter(Builder $builder, Constraint $constraint)
    {
        $data = $constraint->getValue();

        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->where('location->gps_used', '=', "%${data}%");
            return true;
        }
        return false;
    }

    protected function processTaxonomyFamilyFilter(Builder $builder, Constraint $constraint)
    {
        $data = $constraint->getValue();

        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->where('taxonomy_data->family', '=', "%${data}%");
            return true;
        }
        return false;
    }

    protected function processTaxonomyGenusFilter(Builder $builder, Constraint $constraint)
    {
        $data = $constraint->getValue();

        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->where('taxonomy_data->genus', '=', "%${data}%");
            return true;
        }
        return false;
    }

    protected function processTaxonomySpeciesFilter(Builder $builder, Constraint $constraint)
    {
        $data = $constraint->getValue();

        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->where('taxonomy_data->species', '=', "%${data}%");
            return true;
        }
        return false;
    }

    protected function processTaxonomySubSpeciesFilter(Builder $builder, Constraint $constraint)
    {
        $data = $constraint->getValue();

        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->where('taxonomy_data->subspecies', '=', "%${data}%");
            return true;
        }
        return false;
    }

    protected function processTaxonomyVarietyFilter(Builder $builder, Constraint $constraint)
    {
        $data = $constraint->getValue();

        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->where('taxonomy_data->variety', '=', "%${data}%");
            return true;
        }
        return false;
    }

    protected function processTaxonomyPersianNameFilter(Builder $builder, Constraint $constraint)
    {
        $data = $constraint->getValue();

        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->where('taxonomy_data->persian_name', '=', "%${data}%");
            return true;
        }
        return false;
    }

    protected function processTaxonomyLocalNameFilter(Builder $builder, Constraint $constraint)
    {
        $data = $constraint->getValue();

        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->where('taxonomy_data->local_name', '=', "%${data}%");
            return true;
        }
        return false;
    }

    protected function processOrganizationNameFilter(Builder $builder, Constraint $constraint)
    {
        $data = $constraint->getValue();
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->where('organization->name_en', 'LIKE', "%${data}%");


            return true;
        }
        return false;
    }

    protected function processOrganizationCityFilter(Builder $builder, Constraint $constraint)
    {
        $data = $constraint->getValue();
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->where('organization->city', 'LIKE', "%${data}%");


            return true;
        }
        return false;
    }

    protected function processOrganizationPhoneFilter(Builder $builder, Constraint $constraint)
    {
        $data = $constraint->getValue();
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->where('organization->phone', 'LIKE', "%${data}%");


            return true;
        }
        return false;
    }

    protected function processOrganizationFaxFilter(Builder $builder, Constraint $constraint)
    {
        $data = $constraint->getValue();
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->where('organization->fax', 'LIKE', "%${data}%");


            return true;
        }
        return false;
    }

    protected function processOrganizationEmailFilter(Builder $builder, Constraint $constraint)
    {
        $data = $constraint->getValue();
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->where('organization->email', 'LIKE', "%${data}%");


            return true;
        }
        return false;
    }

    protected function processOrganizationDepartmentFilter(Builder $builder, Constraint $constraint)
    {
        $data = $constraint->getValue();
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->where('organization->department_name', 'LIKE', "%${data}%");
            return true;
        }
        return false;
    }
}
