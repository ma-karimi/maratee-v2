<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Plant extends BaseModel
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'plants';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['article_id', 'author_id', 'created_at', 'deleted_at', 'description', 'domestic_name', 'location_id', 'name', 'plant_general_class_id', 'plant_general_cotyledon_id', 'plant_general_family_id', 'plant_general_flowering_id', 'plant_general_genus_id', 'plant_general_group_id', 'plant_general_order_id', 'plant_general_specie_id', 'plant_general_sperm_id', 'plant_general_sub_specie_id', 'plant_general_variety_id', 'updated_at', 'user_id'];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'json',
        'description' => 'json',
        'domestic_name' => 'json',
    ];


    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    public function seeds(): BelongsToMany
    {
        return $this->belongsToMany(Seed::class,
            'seed_plants',
            'plant_id',
            'seed_id');
    }

    /**
     * @return BelongsTo
     */
    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }

    /**
     * @return BelongsTo
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * @return BelongsTo
     */
    public function plantGeneral(): BelongsTo
    {
        return $this->belongsTo(PlantGeneral::class,
            [
                'plant_general_class_id',
                'plant_general_family_id',
                'plant_general_flowering_id',
                'plant_general_genus_id',
                'plant_general_group_id',
                'plant_general_order_id',
                'plant_general_specie_id',
                'plant_general_sperm_id',
                'plant_general_sub_specie_id',
                'plant_general_variety_id',
            ]);
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany
     */
    public function seedPlants(): HasMany
    {
        return $this->hasMany(SeedPlant::class)->latest();
    }
}
