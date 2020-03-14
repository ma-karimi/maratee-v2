<?php

namespace App\Models;

use App\Models\Accessor\ProductAccessor;
use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
    use ProductAccessor, HasMediaTrait;
    public const STATUS = [1 => 'unregistered', 2 => 'registered'];
    public static $rules = [
        'registration_status' => 'nullable|integer|required',
        'consumption' => 'nullable|string',
        'active_compounds' => 'nullable|string',
        'telephone' => 'nullable|string',
        'address' => 'nullable|string',
        'company' => 'nullable|string',
        'pharmaceutical_forms' => 'nullable|string',
        'taxonomy_id' => 'required|exists:taxonomies,id'

    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products';


    protected $with = ['pharmaceutical_form', 'media', 'taxonomy', 'manufacture'];

    protected $appends = ['status_name'];

    public function pharmaceutical_form()
    {
        return $this->belongsTo(MedicinalPlantType::class, 'pharmaceutical_form_id')
            ->where('type_id', 7);
    }
//
//    public function medicinals()
//    {
//        return $this->morphToMany(MedicinalPlant::class, 'hub', 'medicinal_hubs');
//    }


    /**
     * @return BelongsTo
     */
    public function taxonomy(): BelongsTo
    {
        return $this->belongsTo(Taxonomy::class)->withTrashed();
    }

}
