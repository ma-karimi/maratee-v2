<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Media extends BaseModel
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'medias';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['botanical_id', 'created_at', 'date', 'deleted_at', 'description', 'format_type', 'herbarium_id', 'info_type', 'location_id', 'medicinal_plant_id', 'name', 'paleontology_id', 'product_id', 'reference', 'seed_id', 'updated_at', 'user_id'];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = ['info_type' => 'json', 'reference' => 'json'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'date', 'deleted_at', 'updated_at'];

    /**
     * @return BelongsTo
     */
    public function botanical(): BelongsTo
    {
        return $this->belongsTo(Botanical::class);
    }

    /**
     * @return BelongsTo
     */
    public function herbarium(): BelongsTo
    {
        return $this->belongsTo(Herbarium::class);
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
    public function medicinalPlant(): BelongsTo
    {
        return $this->belongsTo(MedicinalPlant::class);
    }

    /**
     * @return BelongsTo
     */
    public function paleontology(): BelongsTo
    {
        return $this->belongsTo(Paleontology::class);
    }

    /**
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * @return BelongsTo
     */
    public function seed(): BelongsTo
    {
        return $this->belongsTo(Seed::class);
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
    public function borrows(): HasMany
    {
        return $this->hasMany(Borrow::class);
    }

    /**
     * @return HasMany
     */
    public function medicinalPlants(): HasMany
    {
        return $this->hasMany(MedicinalPlant::class);
    }

    /**
     * @return HasMany
     */
    public function paleontologyCitations(): HasMany
    {
        return $this->hasMany(PaleontologyCitation::class);
    }

    /**
     * @return HasMany
     */
    public function paleontologyMedias(): HasMany
    {
        return $this->hasMany(PaleontologyMedia::class);
    }

    /**
     * @return HasMany
     */
    public function visits(): HasMany
    {
        return $this->hasMany(Visit::class);
    }
}
