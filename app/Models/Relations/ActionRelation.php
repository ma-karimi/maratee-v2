<?php


namespace App\Models\Relations;


use App\CustomPivot;
use App\Models\Action;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait ActionRelation
{

    /**
     * @return MorphToMany
     */
    public function actions(): MorphToMany
    {
        return $this->morphToMany(Action::class, 'actionable', 'action_hubs')
            ->whereNull('action_hubs.deleted_at')
            ->withTimestamps()
            ->withPivot(['user_id', 'location_id', 'project_id', 'department_id', 'description', 'date'])->using(CustomPivot::class);
    }
}
