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
        return $query->where('type', $type);
    }

    /**
     * @param $query
     * @param $id
     * @param $type
     * @return mixed
     */
    public function scopeOfIdType($query, $id, $type)
    {
        return $query->where('id', $id)->where('type', $type);
    }

    public function scopeOfSelect($query)
    {
        return $query->select('id', 'name');
    }
}
