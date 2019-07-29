<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

/**
 * @SWG\Definition(
 *      definition="TechnologyCollection",
 *      required={"name","paleontology_id"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="seed_technology_id_id",
 *          description="seed_technology_id_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="collection_id",
 *          description="collection_id",
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
class TechnologyCollection extends BaseModel
{

    public static $rules=[
        'seed_technology_id' => 'required|exists:seed_technologies,id',
        'collection_id' => 'required|exists:collections,id',
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'technology_collections';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['collection_id', 'created_at', 'deleted_at', 'seed_technology_id', 'updated_at'];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [];


    public function seedTechnology()
    {
        return $this->belongsTo(SeedTechnology::class, 'seed_technology_id');
    }

    public function collection()
    {
        return $this->belongsTo(Collection::class, 'collection_id');
    }

}
