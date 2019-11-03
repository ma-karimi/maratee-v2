<?php

namespace App\Observers;

use App\Models\Plant;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Parent_;

class PlantObserver extends BaseObserver
{

    protected $model=Plant::class;

    /**
     * Handle the plant "created" event.
     *
     * @param Plant $model
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
    public function updated(Plant $plant)
    {
        //
    }

    /**
     * Handle the plant "deleted" event.
     *
     * @param  \App\Plant  $plant
     * @return void
     */
    public function deleted(Plant $plant)
    {
        //
    }

    /**
     * Handle the plant "restored" event.
     *
     * @param  \App\Plant  $plant
     * @return void
     */
    public function restored(Plant $plant)
    {
        //
    }

    /**
     * Handle the plant "force deleted" event.
     *
     * @param  \App\Plant  $plant
     * @return void
     */
    public function forceDeleted(Plant $plant)
    {
        //
    }
}
