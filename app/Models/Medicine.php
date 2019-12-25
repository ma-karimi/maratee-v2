<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * @SWG\Definition(
 *      definition="Medicine",
 *      required={"name_en"},
 * )
 */
class Medicine extends BaseModel implements HasMedia
{
    use HasMediaTrait;
    public static $rules = [
        'name_en' => 'required|string',
        'name_fa' => 'nullable|string',
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'medicines';
    protected $with = ['industries', 'media'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    protected $appends = ['medicine_industries'];

    public function medicinals()
    {
        return $this->morphToMany(MedicinalPlant::class, 'hub', 'medicinal_hubs');
    }

    public function industries()
    {
        return $this->hasMany(MedicineIndustry::class)->latest();
    }


    public function getMedicineIndustriesAttribute()
    {
        $item = null;

        if ($this->relationLoaded('industries') && $this->industries->count()) {
            $item .= $this->industries->implode('industry', ' & ');
        }
        return $item;
    }

}
