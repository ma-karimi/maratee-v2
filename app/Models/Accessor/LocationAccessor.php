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
        if (isset($value)) {
            $lat = $value->getLat();
            $lng = $value->getLng();
            $coordinate = new Coordinate("$lat, $lng");
            $DMS = explode(', ', (new Geotools())->convert($coordinate)->toDMS());



            $s10 = explode('°', $DMS[0]);
            $s20 = explode('′', $s10[1])[0];
            $s30 = explode('″', $s10[1])[0];
            $DMSN = $s10[0];

            $s11 = explode('°', $DMS[1]);
            $s21 = explode('′', $s11[1])[0];
            $s31 = explode('″', $s11[1])[0];
            $DMSE = $s11[0];

            return [
                'UTM' => [$value->getLng(), $value->getLat()],
                'DMS' => $DMS,
                'DMSN' => $DMSN,
                'DMSE' => $DMSE,
            ];
        }

    }
}
