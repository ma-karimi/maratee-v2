<?php

namespace App\Repositories;

use App\Models\Audit;
use Carbon\Carbon;

/**
 * Class AuditRepository
 * @package App\Repositories
 * @version July 14, 2019, 10:59 am UTC
 */
class AuditRepository extends BaseRepository
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
        return Audit::class;
    }

    public function update($input, $id)
    {
        return parent::update(['status_id' => $input['status_id'], 'approved_at' => $input['status_id'] == 1 ? Carbon::now() : null], $id);
    }
}
