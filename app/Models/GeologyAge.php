<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @SWG\Definition(
 *            name="GeologyAge",
 *            required={"era", "period", "epoch", "stage"},
 * 			@SWG\Property(name="id", type="integer"),
 * 			@SWG\Property(name="era", type="array"),
 * 			@SWG\Property(name="period", type="array"),
 * 			@SWG\Property(name="epoch", type="array"),
 * 			@SWG\Property(name="stage", type="array"),
 * 			@SWG\Property(name="created_at", type="string"),
 * 			@SWG\Property(name="updated_at", type="string"),
 *        )
 **/
class GeologyAge extends BaseModel
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'geology_ages';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['created_at', 'deleted_at', 'epoch', 'era', 'period', 'stage', 'updated_at'];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = ['era' => 'json', 'period' => 'json', 'epoch' => 'json', 'stage' => 'json'];

    /**
     * @return HasMany
     */
    public function paleontologies()
    {
        return $this->hasMany(Paleontology::class)->latest();
    }
}
