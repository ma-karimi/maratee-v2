<?php

namespace App\Repositories;

use App\Models\MedicinalLocationConstituent;

/**
 * Class MedicinalPlantConstituentRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:22 am UTC
 */
class MedicinalPlantConstituentRepository extends BaseRepository
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
        return MedicinalLocationConstituent::class;
    }


    public function storeItems($request, $medicinal_plant_id)
    {
        if (count($request->get('constituents'))) {
            foreach ($request->get('constituents') as $item) {
                if (!empty($item['constituent_type_id']) && !empty($item['value'])) {
                    $this->create([
                        'medicinal_plant_id' => $medicinal_plant_id,
                        'constituent_id' => $item['constituent_id'],
                        'constituent_type_id' => $item['constituent_type_id'],
                        'value' => $item['value'],
                    ]);
                }
            }
        }
    }

    public function updateItems($request, $medicinal_plant_id)
    {
        foreach ($request->get('constituents') as $item) {
            if (!empty($item['constituent_type_id']) && !empty($item['value'])) {
                $record = $this->find($request->get('medicinal_plant_constituent_id'));
                $record->updateOrCreate([
                    'medicinal_plant_id' => $medicinal_plant_id,
                    'constituent_id' => $item['constituent_id'],
                    'constituent_type_id' => $item['constituent_type_id'],
                    'value' => $item['value'],
                ]);
            } else {
                $record = $this->find($request->get('medicinal_plant_constituent_id'));
                $record->delete();
            }
        }

    }

}
