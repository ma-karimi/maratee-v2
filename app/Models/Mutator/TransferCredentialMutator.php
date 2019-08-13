<?php
/**
 * Created by PhpStorm.
 * User: alireza
 * Date: 7/13/19
 * Time: 4:03 PM
 */

namespace App\Models\Mutator;


use Illuminate\Support\Str;

trait TransferCredentialMutator
{

    public function setEntitiableTypeAttribute($value)
    {
        $model = Str::camel($value);
        $this->attributes['entitiable_type'] = "App\Models\{$model}";
    }

    public function setTransferableTypeAttribute($value)
    {
        $model = Str::camel($value);
        $this->attributes['transferable_type'] = "App\Models\{$model}";
    }

}
