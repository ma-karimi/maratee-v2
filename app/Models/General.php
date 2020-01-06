<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
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
    use GeneralScope;
    public const TYPES = ['phytogeography', 'phenology', 'plant_type', 'species', 'sub_species', 'variety', 'family', 'genus', 'class', 'group', 'order', 'flowering', 'sperm', 'cotyledon', 'growth', 'usage', 'part', 'industry', 'application', 'habitat', 'ecology', 'origin', 'lichen', 'moss', 'diatom', 'biological', 'sample'];
    public static $rules = array(
        'name' => 'required|string',
        'type' => 'required|string',
        'parent_id' => 'nullable|integer',
    );
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
}
