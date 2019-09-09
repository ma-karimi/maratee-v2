<?php
/**
 * Created by PhpStorm.
 * User: alireza
 * Date: 7/13/19
 * Time: 4:03 PM
 */

namespace App\Models\Scope;


trait UserScope
{

    /**
     * @param $query
     * @param $email
     * @return mixed
     */
    public function scopeOfEmail($query, $email)
    {
        return $query->where('email', $email);
    }
}
