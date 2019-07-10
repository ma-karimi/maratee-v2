<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use App\Models\GeologyAge;
use App\Models\Locality;
use App\Models\Visit;
use App\Models\Treatment;
use App\Models\PaleontologyMedia;
use App\Models\PaleontologyCitation;
use App\Models\PaleontologyAction;
use App\Models\Media;

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
        'infraspecific'=>'json',
        'typestatus'=>'json',
        'preservation'=>'json',
        'color'=>'json',
        'element'=>'json',
        'treatment'=>'json',
        'additional_info'=>'json',
        'access'=>'json',
        'excavation'=>'json',
        'collection_name'=>'json',
        'common_name'=>'json',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'deleted_at', 'last_update', 'updated_at'];

    public function exchanges()
    {
        return $this->hasMany(Exchange::class, ['send_paleontology_id', 'receive_paleontology_id'])->latest();
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function geologyAge()
    {
        return $this->belongsTo(GeologyAge::class);
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function localities()
    {
        return $this->hasMany(Locality::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function medias()
    {
        return $this->hasMany(Media::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function paleontologyActions()
    {
        return $this->hasMany(PaleontologyAction::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function paleontologyCitations()
    {
        return $this->hasMany(PaleontologyCitation::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function paleontologyMedias()
    {
        return $this->hasMany(PaleontologyMedia::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function treatments()
    {
        return $this->hasMany(Treatment::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function visits()
    {
        return $this->hasMany(Visit::class);
    }
}
