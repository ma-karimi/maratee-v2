<?php

namespace App\Models;

use App\Models\Accessor\ProductAccessor;
use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * @SWG\Definition(
 *      definition="Product",
 *      required={"name"}
 * )
 */
class Product extends BaseModel implements HasMedia
{
    use ProductAccessor,HasMediaTrait;
    public const STATUS = [1 => 'unregistered', 2 => 'registered'];
    public static $linguistically = ['name' => true];
    public static $rules = [
        'registration_status' => 'integer|required',
        'consumption' => 'string',
        'active_compounds' => 'string',
        'manufacturer' => 'string',
        'pharmaceutical_forms' => 'string',
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products';


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'json',
    ];

    protected $with = ['pharmaceutical_form'];

    protected $appends = ['status_name'];

    public function pharmaceutical_form()
    {
        return $this->belongsTo(MedicinalPlantType::class, 'pharmaceutical_form_id')
            ->where('type_id',7);
    }

}
