<?php

namespace App\Repositories;

use App\Models\MedicinalPlant;
use App\Models\MedicinalPlantConstituent;
use App\Repositories\BaseRepository;

/**
 * Class MedicinalPlantRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:22 am UTC
 */
class MedicinalPlantRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [

    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return MedicinalPlant::class;
    }

    public function create($request)
    {
        $medicinal_plant = parent::create($request->all());
        foreach ($request->value as $index => $item) {
            if (!empty($item['value'])) {
                MedicinalPlantConstituent::create([
                    'medicinal_plant_id' => $medicinal_plant->id,
                    'constituent_id' => $request->constituent_id[$index],
                    'constituent_type_id' => $request->constituent_type_id,
                    'value' => $request->$item
                ]);
            }

            return $medicinal_plant->load('medicinalPlantConstituents');
        }
        return $medicinal_plant;
    }
}
