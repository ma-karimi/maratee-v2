<?php
/**
 * Created by PhpStorm.
 * User: alireza
 * Date: 7/13/19
 * Time: 4:03 PM
 */

namespace App\Models\Mutator;


use Grimzy\LaravelMysqlSpatial\Types\Point;
use League\Geotools\Coordinate\Coordinate;

trait LocationMutator
{
    /**
     * @param $value
     */
    public function setPointAttribute($value)
    {
        //$a=implode(', ',['48°49′24″N','2°18′26″E']);
        if (isset($value)){
            $coordinate_string = implode(', ', [$value[0], $value[1]]);
            $coordinate = new Coordinate($coordinate_string);
            $this->attributes['point'] = new Point($coordinate->getLatitude(), $coordinate->getLongitude());
        }
    }
}
