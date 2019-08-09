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
        $lat=$value->getLat();
        $lng=$value->getLng();
        $coordinate = new Coordinate("$lat, $lng");
        $DMS = (new Geotools())->convert($coordinate)->toDMS();
        return [
            'UTM' => [$value->getLng(), $value->getLat()],
            'DMS' => $DMS
        ];
    }
}