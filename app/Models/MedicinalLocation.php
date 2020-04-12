<?php

namespace App\Models;

use App\Models\Accessor\MedicinalLocationAccessor;
use App\Models\Contracts\AuditTrait;
use App\Models\Contracts\BaseModel;
use App\Models\Relations\MedicinalLocationRelations;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * @SWG\Definition(
 *      definition="MedicinalLocation",
 *      required={"taxonomy","location_id"}
 * )
 */
class MedicinalLocation extends BaseModel implements AuditableContract
{
    use MedicinalLocationRelations, MedicinalLocationAccessor, Auditable, AuditTrait;
    public const STUDIED_SAMPLE = [0 => 'unknown', 1 => 'wild', 2 => 'cultivated'];
    protected $with = ['audits', 'taxonomy'];

//
//    /**
//     * The attributes that should be casted to native types.
//     *
//     * @var array
//     */
//    protected $casts = [
//        'efficiency' => 'float',
//    ];

    protected $appends = [
        'studied_sample_name',
        'metabolites',
        'last_audit'
    ];

}
