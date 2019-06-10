<?php

namespace App\Repositories;

use App\Models\RoutineActivityModel;
use App\Repositories\BaseRepository;

/**
 * Class RoutineActivityRepository
 * @package App\Repositories
 * @version June 10, 2019, 10:38 pm UTC
*/

class RoutineActivityRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'routine_id',
        'activity_id',
        'day'
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
        return RoutineActivityModel::class;
    }
}
