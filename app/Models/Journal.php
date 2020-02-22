<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

/**
 * @SWG\Definition(
 *      definition="Journal",
 *      required={"title"}
 * )
 */
class Journal extends BaseModel
{
    public static $rules = [
        'title' => 'required',
    ];
}
