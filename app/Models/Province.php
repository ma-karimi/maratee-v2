<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @SWG\Definition(
 *      definition="Province",
 *      required={"name_en"}
 * )
 */
class Province extends BaseModel
{
    public static $rules = [
        'country_id' => 'required|exists:countries,id',
        'name_en' => 'required|string',
        'name_fa' => 'nullable|string',
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'provinces';
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
//    protected $with = ['cities'];

    /**
     * @return BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * @return HasMany
     */
    public function cities()
    {
        return $this->hasMany(City::class)->latest();
    }


    public function medicinals()
    {
        return $this->morphToMany(MedicinalPlant::class, 'hub', 'medicinal_hubs');
    }

}
