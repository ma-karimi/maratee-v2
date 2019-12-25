<?php

namespace App\Repositories;

use App\Models\Attendance;

/**
 * Class AttendanceRepository
 * @package App\Repositories
 * @version July 14, 2019, 10:36 am UTC
 */
class AttendanceRepository extends BaseRepository
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
        return Attendance::class;
    }
}
