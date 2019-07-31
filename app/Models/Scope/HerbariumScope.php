<?php
/**
 * Created by PhpStorm.
 * User: alireza
 * Date: 7/13/19
 * Time: 4:03 PM
 */

namespace App\Models\Scope;




trait HerbariumScope
{

    /**
     * @param $query
     * @return mixed
     */
    public function scopeIsFlowering($query,$value)
    {
        return $query->where('is_flowering',$value);
    }
}