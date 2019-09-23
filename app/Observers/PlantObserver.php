<?php

namespace App\Observers;

use App\Models\PlantHerbarium;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Parent_;

class PlantObserver extends BaseObserver
{

    protected $model=PlantHerbarium::class;

    /**
     * Handle the plant "created" event.
     *
     * @param PlantHerbarium $model
     * @return void
     */
    public function created(Model $model)
    {
       $this->refreshRedis('id');
    }

    /**
     * Handle the plant "updated" event.
     *
     * @param  \App\Plant  $plant
     * @return void
     */
    public function updated(PlantHerbarium $plant)
    {
        //
    }

    /**
     * Handle the plant "deleted" event.
     *
     * @param  \App\Plant  $plant
     * @return void
     */
    public function deleted(PlantHerbarium $plant)
    {
        //
    }

    /**
     * Handle the plant "restored" event.
     *
     * @param  \App\Plant  $plant
     * @return void
     */
    public function restored(PlantHerbarium $plant)
    {
        //
    }

    /**
     * Handle the plant "force deleted" event.
     *
     * @param  \App\Plant  $plant
     * @return void
     */
    public function forceDeleted(PlantHerbarium $plant)
    {
        //
    }
}
