<?php


namespace App\Models\Contracts;


use Illuminate\Database\Eloquent\Builder;
use Jedrzej\Searchable\Constraint;

trait AuditTrait
{
    public function getLastAuditAttribute()
    {
        return $this->relationLoaded('audits') ? $this->audits()->first() : null;
    }

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
