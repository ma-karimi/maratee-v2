<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

/**
 * @SWG\Definition(
 *      definition="DistributionHub",
 *      required={"geographical_id", "distributable_id", "distributable_type"},
 * )
 */
class DistributionHub extends BaseModel
{

    public static $rules = [
        'geographical_id' => 'required|exists:geographicals,id',
        'distributable_id' => 'required|integer',
        'distributable_type' => 'required'
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'distribution_hubs';

    public function geographical()
    {
        return $this->belongsTo(Geographical::class);
    }

    /**
     * Get the owning distributable model.
     */
    public function distributable()
    {
        return $this->morphTo();
    }

}
