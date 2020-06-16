<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use App\Models\Contracts\GeneralTrait;
use App\Models\Scope\GeneralScope;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * @SWG\Definition(
 *      definition="General",
 *      required={"name","type"}
 * )
 */
class General extends BaseModel
{
    use GeneralScope, GeneralTrait;
    protected $with = ['authors'];

    public const TYPES = ['phytogeography', 'phenology', 'plant_type', 'species', 'sub_species', 'variety', 'family', 'genus', 'class', 'group', 'order', 'flowering', 'cotyledon', 'growth', 'usage', 'part', 'industry', 'application', 'habitat', 'ecology', 'origin', 'lichen', 'moss', 'diatom', 'biological', 'sample'];
    public static $rules = array(
        'name' => 'required|string',
        'type' => 'required|string',
    );
    protected $hidden = ['created_at', 'updated_at', 'deleted_at', 'type', 'authors', 'actors'];

    /**
     * @return MorphToMany
     */
    public function authors(): MorphToMany
    {
        return $this->morphToMany(Actor::class, 'actorable', 'actor_hubs')
            ->whereNull('actor_hubs.deleted_at')
            ->withTimestamps();
    }

}
