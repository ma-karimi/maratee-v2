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
            $DMS = $this->getDms($value);


            $s10 = explode('°', $DMS[0]);
            $s20 = explode('′', $s10[1]);
            $s30 = explode('″', $s20[1]);
            $DMSN = [$s10[0] ?? null, $s20[0] ?? null, $s30[0] ?? null];

            $s11 = explode('°', $DMS[1]);
            $s21 = explode('′', $s11[1]);
            $s31 = explode('″', $s21[1]);
            $DMSE = [$s11[0] ?? null, $s21[0] ?? null, $s31[0] ?? null];

            return [
                'UTM' => [round($value->getLng(), 5), round($value->getLat(), 5)],
                'DMS' => $DMS,
                'DMSN' => $DMSN,
                'DMSE' => $DMSE,
            ];
        }

    }

    /**
     * @param $value
     * @return false|string[]
     */
    private function getDms($value)
    {
        $lat = $value->getLat();
        $lng = $value->getLng();
        $coordinate = new Coordinate("$lat, $lng");
        $DMS = explode(', ', (new Geotools())->convert($coordinate)->toDMS());
        return $DMS;
    }

    public function getLongitudeAttribute()
    {
        return !empty($this->point['UTM'][0]) ? $this->point['UTM'][0] : null;
    }

    public function getLatitudeAttribute()
    {
        return !empty($this->point['UTM'][1]) ? $this->point['UTM'][1] : null;
    }

    public function getAddressAttribute()
    {
        return [];
    }

    public function getLatitudeDegreeAttribute()
    {
        if (!empty($value = $this->point)) {
            return $value['DMSN'][0];
        }

    }

    public function getLatitudeMinuteAttribute()
    {
        if (!empty($value = $this->point)) {
            return $value['DMSN'][1];
        }
    }

    public function getLatitudeSecondAttribute()
    {
        if (!empty($value = $this->point)) {
            return $value['DMSN'][2];
        }
    }

    public function getLongitudeDegreeAttribute()
    {
        if (!empty($value = $this->point)) {
            return $value['DMSE'][0];
        }
    }

    public function getLongitudeMinuteAttribute()
    {
        if (!empty($value = $this->point)) {
            return $value['DMSE'][1];
        }
    }

    public function getLongitudeSecondAttribute()
    {
        if (!empty($value = $this->point)) {
            return $value['DMSE'][2];
        }
    }
}
