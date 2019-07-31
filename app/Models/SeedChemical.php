<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
/**
 * @SWG\Definition(
 *      definition="SeedChemical",
 *      required={"chemical_id","seed_id","treatment","repeat"},
 *      @SWG\Property(
 *          property="chemical_id",
 *          description="chemical_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="seed_id",
 *          description="seed_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="treatment",
 *          description="treatment",
 *          type="array",
	 *     @SWG\Items(type="string")
 *      ),
 *      @SWG\Property(
 *          property="repeat",
 *          description="repeat",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="location_id",
 *          description="location_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */

class SeedChemical extends BaseModel
{
    public static $linguistically=['treatment'=>true];

    public static $rules=[
        'chemical_id' => 'required|exists:chemicals,id',
        'seed_id' => 'required|exists:seeds,id',
        'repeat' => 'required|integer',
        'location_id' => 'exists:locations,id',
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'seed_chemicals';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['chemical_id', 'created_at', 'deleted_at', 'location_id', 'repeat', 'seed_id', 'treatment', 'updated_at'];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'treatment' => 'json'
    ];

    /**
     * @return BelongsTo
     */
    public function chemical()
    {
        return $this->belongsTo('App\Models\Chemical');
    }

    /**
     * @return BelongsTo
     */
    public function location()
    {
        return $this->belongsTo('App\Models\Location');
    }

    /**
     * @return BelongsTo
     */
    public function seed()
    {
        return $this->belongsTo('App\Models\Seed');
    }


}
