<?php
/**
 * Created by PhpStorm.
 * User: alireza
 * Date: 7/13/19
 * Time: 4:03 PM
 */

namespace App\Models\Mutator;


use App\Models\MedicinalPart;
use Illuminate\Support\Arr;

trait MedicinalPartMutator
{
    /**
     * @param $value
     */
    public function setTypeAttribute($value)
    {
        if (in_array($value,MedicinalPart::TYPE))
        $this->attributes['type'] = array_search($value,MedicinalPart::TYPE);
    }
}