<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @SWG\Definition(
 *            definition="Dimension",
 *           required={"name","type"},
 * 			@SWG\Property(property="id", type="integer"),
 * 			@SWG\Property(property="name", type="string"),
 * 			@SWG\Property(property="type", type="string"),
 * 			@SWG\Property(property="index", type="integer"),
 *        )
 */
class Dimension extends BaseModel
{
    public static $rules = [
        'name' => 'required|string',
        'type' => 'required|string',
        'index' => 'integer',
    ];

    public function evaluations()
    {
        return $this->belongsToMany(Evaluation::class,
            'evaluation_dimensions',
            'dimension_id',
            'evaluation_id')->withPivot('value')->withTimestamps();
    }

}
