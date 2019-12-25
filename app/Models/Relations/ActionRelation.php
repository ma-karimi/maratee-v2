<?php


namespace App\Models\Relations;


use App\Models\Action;
use App\Models\ActionHub;

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
