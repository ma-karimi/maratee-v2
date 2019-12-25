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
            $s20 = explode('′', $s10[1]);
            $s30 = explode('″', $s20[1]);
            $DMSN = [$s10[0], $s20[0], $s30[0]];

            $s11 = explode('°', $DMS[1]);
            $s21 = explode('′', $s11[1]);
            $s31 = explode('″', $s21[1]);
            $DMSE = [$s11[0], $s21[0], $s31[0]];

            return [
                'UTM' => [$value->getLng(), $value->getLat()],
                'DMS' => $DMS,
                'DMSN' => $DMSN,
                'DMSE' => $DMSE,
            ];
        }

    }

    public function getAddressAttribute()
    {
        return [];
    }
}
