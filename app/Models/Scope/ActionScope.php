<?php
/**
 * Created by PhpStorm.
 * User: alireza
 * Date: 7/13/19
 * Time: 4:03 PM
 */

namespace App\Models\Scope;


use App\Models\User;

trait ActionScope
{

    /**
     * @param $query
     * @return mixed
     */
    public function scopeOfCollectingAction($query)
    {
        return $query->where('name->en','LIKE','%collect%');
    }
}