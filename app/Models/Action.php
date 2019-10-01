<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use App\Models\Scope\ActionScope;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;


/**
 * @SWG\Definition(
 *      definition="Action",
 *      required={"name"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="array",
 *     @SWG\Items(type="string"),
 *          format="array"
 *      ),
 *      @SWG\Property(
 *          property="description",
 *          description="description",
 *          type="array",
 *     @SWG\Items(type="string"),
 *          format="array"
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
class Action extends BaseModel implements HasMedia
{

    public const TYPES = ['detect' => 'detect', 'collect' => 'collect'];

    use ActionScope, HasMediaTrait;
    public static $linguistically = ['name' => true, 'description' => true];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'actions';

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = ['name' => 'json', 'description' => 'json'];

    public function plants()
    {
        return $this->morphedByMany(PlantHerbarium::class, 'actionable', 'action_hubs')->withTimestamps();
    }

    public function cryoBanks()
    {
        return $this->morphedByMany(CryoBank::class, 'actionable', 'action_hubs')->withTimestamps();
    }

    public function paleontologies()
    {
        return $this->morphedByMany(Paleontology::class, 'actionable', 'action_hubs')->withTimestamps();
    }
}
