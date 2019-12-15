<?php

namespace App\Repositories;

use App\Models\MedicinalHub;

/**
 * Class MedicinalHubRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:22 am UTC
 */
class MedicinalHubRepository extends BaseRepository
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
        return MedicinalHub::class;
    }


    public function storeItems($request, $medicinal_plant_id)
    {
        if (count($request->get('provinces'))) {
            foreach ($request->get('provinces') as $item) {
                $this->create([
                    'medicinal_plant_id' => $medicinal_plant_id,
                    'province_id' => $item['province_id'],
                ]);
            }
        }
    }

    public function updateItems($request, $medicinal_plant_id)
    {

        $m_p_provinces = $this->model->where('medicinal_plant_id', $medicinal_plant_id)->select('province_id')->get();
        $m_p_provinces->diff($request->get('provinces'))->each(function ($query) use ($medicinal_plant_id) {
            $this->model->where(['medicinal_plant_id' => $medicinal_plant_id, 'province_id' => $query->province_id])->delete();
        });
        foreach ($request->get('provinces') as $item) {
            $this->model->firstOrCreate(['medicinal_plant_id' => $medicinal_plant_id, 'province_id' => $item['province_id']]);
        }

    }

}
