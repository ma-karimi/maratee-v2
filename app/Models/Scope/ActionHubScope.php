<?php
/**
 * Created by PhpStorm.
 * User: alireza
 * Date: 7/13/19
 * Time: 4:03 PM
 */

namespace App\Models\Scope;


use App\Models\User;
use function foo\func;

trait ActionHubScope
{

    /**
     * @param $query
     * @param $type
     * @return mixed
     */
    public function scopeOfAction($query,$type)
    {
        return $query->whereHas('action',function ($query) use ($type){
             $query->where('name->en','LIKE',"%{$type}%");
        });
    }
}