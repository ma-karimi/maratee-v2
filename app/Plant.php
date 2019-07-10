<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $plant_general_sub_specie_id
 * @property int $plant_general_variety_id
 * @property int $plant_general_specie_id
 * @property int $plant_general_class_id
 * @property int $plant_general_group_id
 * @property int $plant_general_order_id
 * @property int $plant_general_flowering_id
 * @property int $plant_general_sperm_id
 * @property int $plant_general_family_id
 * @property int $plant_general_genus_id
 * @property int $user_id
 * @property int $article_id
 * @property int $author_id
 * @property int $location_id
 * @property mixed $name
 * @property mixed $description
 * @property mixed $domestic_name
 * @property int $plant_general_cotyledon_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Article $article
 * @property Author $author
 * @property Location $location
 * @property PlantGeneral $plantGeneral
 * @property PlantGeneral $plantGeneral
 * @property PlantGeneral $plantGeneral
 * @property PlantGeneral $plantGeneral
 * @property PlantGeneral $plantGeneral
 * @property PlantGeneral $plantGeneral
 * @property PlantGeneral $plantGeneral
 * @property PlantGeneral $plantGeneral
 * @property PlantGeneral $plantGeneral
 * @property PlantGeneral $plantGeneral
 * @property User $user
 * @property SeedHasPlant[] $seedHasPlants
 * @property SeedPlant[] $seedPlants
 */
class Plant extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['plant_general_sub_specie_id', 'plant_general_variety_id', 'plant_general_specie_id', 'plant_general_class_id', 'plant_general_group_id', 'plant_general_order_id', 'plant_general_flowering_id', 'plant_general_sperm_id', 'plant_general_family_id', 'plant_general_genus_id', 'user_id', 'article_id', 'author_id', 'location_id', 'name', 'description', 'domestic_name', 'plant_general_cotyledon_id', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The storage format of the model's date columns.
     * 
     * @var string
     */
    protected $dateFormat = 'U';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function article()
    {
        return $this->belongsTo('App\Models\Article');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo('App\Models\Author');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function location()
    {
        return $this->belongsTo('App\Models\Location');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function plantGeneral()
    {
        return $this->belongsTo('App\Models\PlantGeneral', 'plant_general_class_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function plantGeneral()
    {
        return $this->belongsTo('App\Models\PlantGeneral', 'plant_general_family_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function plantGeneral()
    {
        return $this->belongsTo('App\Models\PlantGeneral', 'plant_general_flowering_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function plantGeneral()
    {
        return $this->belongsTo('App\Models\PlantGeneral', 'plant_general_genus_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function plantGeneral()
    {
        return $this->belongsTo('App\Models\PlantGeneral', 'plant_general_group_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function plantGeneral()
    {
        return $this->belongsTo('App\Models\PlantGeneral', 'plant_general_order_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function plantGeneral()
    {
        return $this->belongsTo('App\Models\PlantGeneral', 'plant_general_specie_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function plantGeneral()
    {
        return $this->belongsTo('App\Models\PlantGeneral', 'plant_general_sperm_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function plantGeneral()
    {
        return $this->belongsTo('App\Models\PlantGeneral', 'plant_general_sub_specie_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function plantGeneral()
    {
        return $this->belongsTo('App\Models\PlantGeneral', 'plant_general_variety_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function seedHasPlants()
    {
        return $this->hasMany('App\Models\SeedHasPlant');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function seedPlants()
    {
        return $this->hasMany('App\Models\SeedPlant');
    }
}
