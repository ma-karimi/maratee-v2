<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use App\Models\Contracts\GeneralTrait;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * @SWG\Definition(
 *      definition="PaleobotanyGeneral",
 *      required={"name","type"}
 * )
 */
class PaleobotanyGeneral extends BaseModel
{
    public const TYPES = ['type_status', 'species', 'infra_specific', 'family', 'genus', 'order', 'sample', 'division', 'preservation'];
    public static $rules = array(
        'name' => 'required|string',
        'type' => 'required|string',
    );
    use GeneralTrait;
    protected $with = ['authors'];

    protected $appends = ['name_author', 'actors'];
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * @return MorphToMany
     */
    public function authors(): MorphToMany
    {
        return $this->morphToMany(Actor::class, 'actorable', 'actor_hubs')
            ->whereNull('actor_hubs.deleted_at')
            ->withTimestamps();
    }


    public function scopeOfSelect($query)
    {
        return $query->select('id', 'name');
    }

}
