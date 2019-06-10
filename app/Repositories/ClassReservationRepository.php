<?php

namespace App\Repositories;

use App\Models\ClassReservationModel;
use App\Repositories\BaseRepository;

/**
 * Class ClassReservationRepository
 * @package App\Repositories
 * @version June 10, 2019, 10:37 pm UTC
*/

class ClassReservationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'client_id',
        'class_schedule_id',
        'day',
        'start_time',
        'date',
        'status'
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
        return ClassReservationModel::class;
    }
}
