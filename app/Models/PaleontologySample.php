<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

/**
 * @SWG\Definition(
 *      definition="PaleontologyDocument",
 *      required={"paleontology_id","sample_id"}
 * )
 */
class PaleontologySample extends BaseModel
{
    public static $rules = [
        'paleontology_id' => 'required|exists:paleontologies,id',
        'sample_id' => 'required|exists:generals,id',
    ];
}
