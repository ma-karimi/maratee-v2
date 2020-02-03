<?php


namespace App\Models\Scope;


use Illuminate\Database\Eloquent\Builder;
use Jedrzej\Searchable\Constraint;

trait AuditScope
{
    protected function processAudits_statusIdFilter(Builder $builder, Constraint $constraint)
    {
        if ($constraint->getOperator() === Constraint::OPERATOR_IN) {

            $builder
                ->whereHas('audits', function ($relation) use ($constraint) {
                    return $relation->where('status_id', $constraint->getOperator(), $constraint->getValue());

                });


            return true;
        }
        return false;
    }
}
