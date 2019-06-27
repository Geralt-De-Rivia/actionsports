<?php

namespace App\Repositories;

use App\Models\ClassReservation;
use App\Models\ClassReservationModel;
use App\Repositories\BaseRepository;

/**
 * Class ClassReservationRepository
 * @package App\Repositories
 * @version June 27, 2019, 5:48 pm -05
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
