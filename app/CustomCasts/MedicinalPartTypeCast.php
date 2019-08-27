<?php
/**
 * Created by PhpStorm.
 * User: omid
 * Date: 8/27/19
 * Time: 11:20 AM
 */

namespace App\CustomCasts;


use App\Models\MedicinalPart;
use Illuminate\Support\Arr;

class MedicinalPartTypeCast
{
    public function setAttribute($value)
    {
        if (in_array($value,MedicinalPart::TYPE))
            return array_search($value,MedicinalPart::TYPE) ;
    }

    public function castAttribute($value)
    {
        return Arr::get(MedicinalPart::TYPE,$value);
    }

}