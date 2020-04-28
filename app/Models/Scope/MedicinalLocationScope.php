<?php


namespace App\Models\Scope;


use Illuminate\Database\Eloquent\Builder;
use Jedrzej\Searchable\Constraint;

trait MedicinalLocationScope
{

    public function scopeOfConstituent($builder)
    {

        $value1 = Constraint::make(request()->get('constituents:constituent_type_id'));
        $value2 = Constraint::make(request()->get('constituents:value'));

//
//        // this logic should happen for LIKE/EQUAL operators only
        return $builder->whereHas('constituents', function ($query) use ($value1, $value2) {
            $query->where('constituent_type_id', $value1->getOperator(), $value1->getValue())
                ->where('value', $value2->getOperator(), $value2->getValue());
        });

    }

    protected function processConstituents_ValueFilter(Builder $builder, Constraint $constraint)
    {

        if (request()->filled('constituent') && count(request()->get('constituent'))) {
            return false;
        }

        // this logic should happen for LIKE/EQUAL operators only
        $builder->whereHas('constituents', function ($query) use ($constraint) {
            $query->where('value', $constraint->getOperator(), $constraint->getValue());
        });

    }

    protected function processConstituents_ConstituentTypeIdFilter(Builder $builder, Constraint $constraint)
    {

        if (request()->filled('constituent') && count(request()->get('constituent'))) {
            return false;
        }


        // this logic should happen for LIKE/EQUAL operators only
        $builder->whereHas('constituents', function ($query) use ($constraint) {
            $query->where('constituent_type_id', $constraint->getOperator(), $constraint->getValue());
        });

    }

}
