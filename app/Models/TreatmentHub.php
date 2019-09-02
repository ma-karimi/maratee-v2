<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

/**
 * @SWG\Definition(
 *      definition="TreatmentHub",
 *      required={"treatment_id", "treatmentable_id", "treatmentable_type"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="treatmentable_type",
 *          description="medicinal_plant, paleontology, botanical, cryo_bank, bio_molecular",
 *          type="string",
 *      ),
 *      @SWG\Property(
 *          property="treatmentable_id",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="treatment_id",
 *          description="treatment_id",
 *          type="integer",
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */
class TreatmentHub extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'treatment_hubs';

}
