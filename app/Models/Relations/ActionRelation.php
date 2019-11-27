<?php


namespace App\Models\Relations;


use App\CustomPivot;
use App\Models\Action;
use App\Models\ActionHub;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait ActionRelation
{
    public function collect()
    {
        return $this->morphOne(ActionHub::class, 'actionable')->where('action_id', 2);
    }

    public function research()
    {
        return $this->morphOne(ActionHub::class, 'actionable')->where('action_id', 3);
    }
}
