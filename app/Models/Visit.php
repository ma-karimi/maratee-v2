<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

/**
 * @SWG\Definition(
 *      definition="Visit",
 *      required={"date","user_id"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *        @SWG\Property(
 *          property="date",
 *          description="date",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="description",
 *          description="description",
 *          type="array",
 *     @SWG\Items(type="string"),
 *          format="array"
 *      ),
 *      @SWG\Property(
 *          property="purpose",
 *          description="purpose",
 *          type="array",
 *     @SWG\Items(type="string"),
 *          format="array"
 *      ),
 *      @SWG\Property(
 *          property="peoples",
 *          description="peoples",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="archives_types",
 *          description="archives_types",
 *          type="string",
 *      ),
 *      @SWG\Property(
 *          property="archive_no",
 *          description="archive_no",
 *          type="string",
 *      ),
 *      @SWG\Property(
 *          property="plantology_id",
 *          description="plantology_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="media_id",
 *          description="plantology_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="user_id",
 *          description="plantology_id",
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
class Visit extends BaseModel
{
    public static $linguistically = ['description' => false, 'purpose' => false];

    public static $rules = [
        'date' => 'required|date',
        'user_id' => 'required|exists:users,id',
        'peoples' => 'integer',
        'archives_types' => 'string',
        'archive_no' => 'string',
        'paleontology_id' => 'integer',
        'media_id' => 'integer',
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'visits';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['archive_no', 'archives_types', 'created_at', 'date', 'deleted_at', 'description', 'media_id', 'paleontology_id', 'peoples', 'purpose', 'updated_at', 'user_id'];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'description' => 'json',
        'purpose' => 'json'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'date', 'deleted_at', 'updated_at'];

    public function media()
    {
        return $this->belongsTo(Media::class, 'media_id');
    }

    public function paleontology()
    {
        return $this->belongsTo(Paleontology::class, 'paleontology_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
