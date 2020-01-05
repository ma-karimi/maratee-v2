<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

/**
 * @SWG\Definition(
 *      definition="PaleontologyCitation",
 *      required={"paleontology_id","citation_id"}
 * )
 */
class PaleontologyCitation extends BaseModel
{
    public static $rules = [
        'paleontology_id' => 'required|exists:paleontologies,id',
        'citation_id' => 'required|exists:citations,id',
    ];
}
