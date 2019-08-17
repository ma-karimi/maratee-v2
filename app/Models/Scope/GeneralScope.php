<?php
/**
 * Created by PhpStorm.
 * User: alireza
 * Date: 7/13/19
 * Time: 4:03 PM
 */

namespace App\Models\Scope;


trait GeneralScope
{
    /**
     * @param $query
     * @param bool $value
     * @return mixed
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('type',$type);
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
