<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @SWG\Definition(
 *      definition="Locality",
 *      required={"paleontology_id","location_id"}
 * )
 */
class Locality extends BaseModel
{
    public static $rules = [
        'paleontology_id' => 'required|exists:paleontologies,id',
        'location_id' => 'required|exists:locations,id',
        'formation' => 'string',
        'layer' => 'string',
        'stratigraphy' => 'string',
        'fauna' => 'string',
        'description' => 'string',
        'lithology' => 'string',
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'localities';

    /**
     * @return BelongsTo
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

}
