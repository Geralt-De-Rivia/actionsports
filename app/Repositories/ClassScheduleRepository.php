<?php

namespace App\Repositories;

use App\Models\ClassScheduleModel;
use App\Repositories\BaseRepository;

/**
 * Class ClassScheduleRepository
 * @package App\Repositories
 * @version June 11, 2019, 6:00 pm UTC
*/

class ClassScheduleRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'class_id',
        'user_id',
        'quota_min',
        'quota_max',
        'start_at',
        'end_at',
        'status',
        'recurrence'
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
        return ClassScheduleModel::class;
    }
}
