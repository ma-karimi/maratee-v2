<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Paleontology extends BaseModel
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'paleontologies';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['access', 'additional_info', 'barcode_no', 'catalog_no', 'closet', 'collection_name', 'color', 'common_name', 'created_at', 'deleted_at', 'drawer', 'element', 'excavation', 'field_no', 'geology_age_id', 'infraspecific', 'last_update', 'location_no', 'move_status', 'pieces', 'preservation', 'salon', 'specimen_no', 'treatment', 'typestatus', 'updated_at'];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'infraspecific' => 'json',
        'typestatus' => 'json',
        'preservation' => 'json',
        'color' => 'json',
        'element' => 'json',
        'treatment' => 'json',
        'additional_info' => 'json',
        'access' => 'json',
        'excavation' => 'json',
        'collection_name' => 'json',
        'common_name' => 'json',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'deleted_at', 'last_update', 'updated_at'];

    /**
     * @return HasMany
     */
    public function exchanges(): HasMany
    {
        return $this->hasMany(Exchange::class, ['send_paleontology_id', 'receive_paleontology_id'])->latest();
    }

    /**
     * @return BelongsTo
     */
    public function geologyAge(): BelongsTo
    {
        return $this->belongsTo(GeologyAge::class);
    }

    /**
     * @return HasMany
     */
    public function localities(): HasMany
    {
        return $this->hasMany(Locality::class)->latest();
    }

    /**
     * @return HasMany
     */
    public function medias(): HasMany
    {
        return $this->hasMany(Media::class)->latest();
    }

    /**
     * @return HasMany
     */
    public function paleontologyActions(): HasMany
    {
        return $this->hasMany(PaleontologyAction::class)->latest();
    }

    /**
     * @return HasMany
     */
    public function paleontologyCitations(): HasMany
    {
        return $this->hasMany(PaleontologyCitation::class)->latest();
    }

    /**
     * @return HasMany
     */
    public function paleontologyMedias(): HasMany
    {
        return $this->hasMany(PaleontologyMedia::class)->latest();
    }

    /**
     * @return HasMany
     */
    public function treatments(): HasMany
    {
        return $this->hasMany(Treatment::class)->latest();
    }

    /**
     * @return HasMany
     */
    public function visits(): HasMany
    {
        return $this->hasMany(Visit::class)->latest();
    }
}
