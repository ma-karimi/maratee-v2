<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

/**
 * @SWG\Definition(
 *      definition="PaleontologyGeneral",
 *      required={"paleontology_id","general_id"}
 * )
 */
class PaleontologyGeneral extends BaseModel
{
    public static $rules = [
        'paleontology_id' => 'required|exists:paleontologies,id',
        'general_id' => 'required|exists:generals,id',
    ];
}
