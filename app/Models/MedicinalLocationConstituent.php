<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @SWG\Definition(
 *      definition="MedicinalLocationConstituent",
 *      required={"medicinal_location_id","constituent_id","value"}
 * )
 */
class MedicinalLocationConstituent extends BaseModel
{
    public static $rules = [
        'constituents'=>'required'

    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'medicinal_location_constituents';

    protected $with = ['constituentType'];

    /**
     * @return BelongsTo
     */
    public function constituent(): BelongsTo
    {
        return $this->belongsTo(Constituent::class);
    }

    /**
     * @return BelongsTo
     */
    public function constituentType(): BelongsTo
    {
        return $this->belongsTo(ConstituentType::class);
    }

    /**
     * @return BelongsTo
     */
    public function medicinalLocation(): BelongsTo
    {
        return $this->belongsTo(MedicinalLocation::class);
    }

}
