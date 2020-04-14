<?php

namespace App\Models;

use App\Models\Accessor\MedicinalApplicationAccessor;
use App\Models\Contracts\AuditTrait;
use App\Models\Contracts\BaseModel;
use App\Models\Relations\MedicinalApplicationRelations;
use App\Models\Scope\MedicinalApplicationScope;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * @SWG\Definition(
 *      definition="MedicinalApplication",
 *      required={"taxonomy_id"},
 * )
 */
class MedicinalApplication extends BaseModel implements HasMedia, AuditableContract
{
    use MedicinalApplicationAccessor, MedicinalApplicationScope, MedicinalApplicationRelations, HasMediaTrait, Auditable, AuditTrait;

    public const TRADITIONAL_IRANIAN_MEDICINE = [1 => 'raw', 2 => 'processed', 3 => 'raw & processed'];
    public const NATURAL_DRUG = [1 => 'human medicines', 2 => 'animal drugs'];
    public const INHERBAL_MEDICINE_STORE = [1 => 'raw', 2 => 'processed', 3 => 'raw & processed'];
    public const EXPORTING = [1 => 'raw', 2 => 'processed'];
    public const IMPORTING = [1 => 'raw', 2 => 'processed'];


    public const BOOLEAN = [0 => 'No', 1 => 'Yes'];

    public static $rules = [
        'taxonomy_id' => 'required|exists:taxonomies,id',
        'traditional_iranian_medicine' => 'nullable|numeric',
        'exporting' => 'required',
        'importing' => 'required',
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'medicinal_applications';

    protected $appends = [
        'traditional_iranian_medicine_name',
        'natural_drug_name',
        'inherbal_medicine_store_name',
        'exporting_name',
        'importing_name',
        'cultivated_area',
        'hygienic_cosmetic',
        'potentials',
        'foods',
        'industries',
        'last_audit',
    ];

    protected $with = ['audits', 'taxonomy'];
}
