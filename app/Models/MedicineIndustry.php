<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;
use Illuminate\Support\Arr;

/**
 * @SWG\Definition(
 *      definition="MedicineIndustry",
 *      required={"medicine_id","industry_id"},
 * )
 */
class MedicineIndustry extends BaseModel
{
    public const TYPE = [
        1 => 'Food Industry',
        2 => 'Hygienic Cosmetic',
        3 => 'Pharmaceutical',
        4 => 'Flourishes',
        5 => 'Extracts and essential oils',
        6 => 'Fresheners',
        7 => 'Color',
        8 => 'Oil',
        9 => 'Tobacco',
        10 => 'Paper',
        11 => 'Glue',
        12 => 'Toxins and herbal pesticides'
    ];
    protected $table = 'medicine_industries';
    protected $appends = ['type'];

    public function getTypeAttribute()
    {
        return Arr::get(self::TYPE, $this->type_id);
    }
}
