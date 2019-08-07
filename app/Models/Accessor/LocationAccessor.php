<?php
/**
 * Created by PhpStorm.
 * User: alireza
 * Date: 7/13/19
 * Time: 4:01 PM
 */

namespace App\Models\Accessor;


use League\Geotools\Coordinate\Coordinate;
use League\Geotools\Geotools;

trait LocationAccessor
{
    public function getPointAttribute($value)
    {
        $coordinate = new Coordinate($value->getLat(), $value->getLng());
        $DMS = (new Geotools())->convert($coordinate)->toDMS();
        return [
            'UTM' => $value->getLng(), $value->getLat(),
            'DMS' => $DMS
        ];
    }
}