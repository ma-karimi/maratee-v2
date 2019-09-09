<?php
/**
 * Created by PhpStorm.
 * User: alireza
 * Date: 7/13/19
 * Time: 4:03 PM
 */

namespace App\Models\Scope;


trait PlantScope
{
    /**
     * @param $query
     * @return mixed
     */
    public function scopeIsFlowering($query,$value)
    {
        return $query->where('is_flowering',$value);
    }
    /**
     * @param $query
     * @param bool $value
     * @return mixed
     */
    public function scopeOfFloweringHerbariums($query,bool $value=false)
    {
        return $query->whereHas('herbariums', function ($query) use($value){
             $query->isFlowering($value);
        });
    }


    /**
     * @param $query
     * @param bool $value
     * @return mixed
     */
    /*public function scopeIsFlower($query,bool $value)
    {
        return $query->whereHas('general', function (Builder $query) {
            $query->where('type','flowering');
        })->where('general_flowering_id',$value)->get();
    }*/
}
