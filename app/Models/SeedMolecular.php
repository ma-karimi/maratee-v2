<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
/**
 * @SWG\Definition(
 *      definition="SeedMolecular",
 *      required={"molecular_id","seed_id","treatment","repeat"},
 *      @SWG\Property(
 *          property="molecular_id",
 *          description="molecular_id",
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
 *          property="location_id",
 *          description="location_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="treatment",
 *          description="treatment",
 *          type="array",
	 *     @SWG\Items(type="string"),
 *          format="array"
 *      ),
 *      @SWG\Property(
 *          property="repeat",
 *          description="repeat",
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

class SeedMolecular extends BaseModel
{

    public static $linguistically=['treatment'=>true];
    public static $rules=[
        'molecular_id' => 'required|exists:moleculars,id',
        'seed_id' => 'required|exists:seeds,id',
        'location_id' => 'integer',
        'repeat' => 'required|integer',
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'seed_moleculars';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['created_at', 'deleted_at', 'location_id', 'molecular_id', 'repeat', 'seed_id', 'treatment', 'updated_at'];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'treatment' => 'json'
    ];

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function molecular()
    {
        return $this->belongsTo(Molecular::class, 'molecular_id');
    }

    public function seed()
    {
        return $this->belongsTo(Seed::class, 'seed_id');
    }

}
